<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Review;
use App\Models\ReviewRating;
use App\Models\Type;
use App\Models\User;
use App\Models\Level;
use App\Models\Team;
use App\Models\TeamPlayer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class GameController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new middleware('auth')
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $typesWithGames = Type::whereHas('levels.enrolments', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['levels' => function ($query) use ($user) {
            $query->whereHas('enrolments', function ($subQuery) use ($user) {
                $subQuery->where('user_id', $user->id);
            });
        }, 'levels.type.games'])->get();

        return view('games.index', compact('user', 'typesWithGames'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (Auth::user()->role !== 'coach') {
            return redirect()->route('home')->with('error', 'Access denied. Only coaches can perform this action.');
        }
        $type_id = $request->query('type_id');
        $type = Type::findOrFail($type_id);
        
        return view('games.create_form', compact('type'));        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'coach') {
            return redirect()->route('home')->with('error', 'Access denied. Only coaches can perform this action.');
        }
        $validate = $request->validate([
            'title' => 'required|min:20',
            'reviews_required' => ['required_if:assign_type,player','nullable','numeric','min:1'],
            'max_score' => 'required|numeric|min:1|max:100',
            'due_date' => 'required|date',
            'assign_type' => 'required|string|in:coach,player',
            'type_id' => 'exists:types,id',
            'instructions' => 'required|string',
        ]);
        $game = new Game();
        $game->title = $request->title;
        $game->instructions = $request->instructions;
        $game->reviews_required = $request->assign_type === 'coach' ? null : $request->reviews_required;
        $game->max_score = $request->max_score;
        $game->due_date = $request->due_date;
        $game->assign_type = $request->assign_type;
        $game->coach_id = Auth::user()->id;
        $game->type_id = $request->type_id;
        $game->save();
        return redirect()->route('games.show', ['game' => $game->id])->with('success', 'Game created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = Auth::user();
        $game = Game::findOrFail($id);
        $type = Type::findOrFail($game->type_id);
        $coach = User::findOrFail($game->coach_id);
        $review = Review::where('game_id', $game->id)->get();

        if ($game->assign_type == 'coach') {
            if (!$game->teams()->exists()) {
                if ($user->role == 'coach') {
                    return redirect()->route('games.choose_level', $game->id);
                }
                return redirect()->route('home')->with('error', 'The game is not available yet.');
            }
        }

        if ($user->role == 'player') {
            $submittedReviews = Review::where('reviewer_id', $user->id)->where('game_id', $game->id)->get();
            $receivedReviews = Review::where('reviewee_id', $user->id)->where('game_id', $game->id)->with('reviewer')->get();
            $playerLevel = $user->enrolments()->whereHas('level', function($query) use ($game) {
                $query->where('type_id', $game->type_id);
            })->first();
            $rankedReviewsCount = $receivedReviews->whereNotNull('rank')->count();
            $allRanked = ($rankedReviewsCount == $receivedReviews->count());

            if ($playerLevel) {
                if ($game->assign_type == 'coach') {
                    $teams = Team::where('game_id', $id)->whereHas('players', function ($query) use ($user) {
                        $query->where('player_id', $user->id);
                    })->get();
                
                    $enrolledPlayers = $teams->flatMap(function ($team) {
                        return $team->players; 
                    })->unique('id')->where('id', '!=', $user->id);
                } else {
                    $enrolledPlayers = User::whereHas('enrolments.level.type', function ($query) use ($game, $type) {
                        $query->where('type_id', $type->id);
                    })->where('id', '!=', $user->id)
                      ->where('role', 'player')
                      ->get();                    
                }
            } 
            return view('games.show', compact('game', 'review', 'type', 'coach', 'submittedReviews', 'receivedReviews', 'enrolledPlayers', 'rankedReviewsCount', 'allRanked'));

        } elseif ($user->role == 'coach') {
            $levelsForGame = Level::where('type_id', $game->type_id)->get();

            $playersWithReviews = collect();
            $levelsWithTeams = collect();
            $playersByLevel = collect();

            if ($game->assign_type == 'coach') {
                $teams = Team::where('game_id', $game->id)->get();

                $players = $teams->flatMap(function ($team) {
                    return $team->players;
                })->unique();

                $levelsWithTeams = Level::where('type_id', $game->type_id)
                    ->paginate(1)
                    ->through(function ($level) use ($teams) {
                        $filteredTeams = $teams->filter(function ($team) use ($level) {
                            return $team->level_id == $level->id;
                        });
                        
                        return [
                            'level' => $level,
                            'teams' => $filteredTeams
                        ];
                    });

            } else {
                if ($game->teams()->exists()) {
                    foreach ($game->teams as $team) {
                        $team->players()->detach(); 
                    }
                    $game->teams()->delete(); 
                }

                $players = User::whereHas('enrolments', function ($query) use ($levelsForGame) {
                    $query->whereIn('level_id', $levelsForGame->pluck('id'));
                })->where('role', 'player')->get();

                $playersByLevel = Level::where('type_id', $game->type_id)
                    ->with(['enrolments' => function ($query) {
                        $query->whereHas('player', function ($q) {
                            $q->where('role', 'player');
                        });
                    }])->paginate(1);
            }

            $playersWithReviews = $players->map(function ($player) use ($game) {
                $submittedReviewsCount = Review::where('reviewer_id', $player->id)->where('game_id', $game->id)->count();
                $receivedReviewsCount = Review::where('reviewee_id', $player->id)->where('game_id', $game->id)->count();
                $score = Review::where('game_id', $game->id)->where('reviewee_id', $player->id)->avg('score');

                return [
                    'player' => $player,
                    'submittedReviewsCount' => $submittedReviewsCount,
                    'receivedReviewsCount' => $receivedReviewsCount,
                    'score' => $score ?? 'No score'
                ];
            });

            $levels = Level::where('type_id', $game->type_id)
                ->with(['teams' => function ($query) use ($game) {
                    $query->where('game_id', $game->id);
                }])->get();


            if ($game->assign_type == 'coach') {
                return view('games.show', compact('game', 'coach', 'type', 'review', 'levelsWithTeams', 'playersWithReviews', 'levels'));
            } else {
                return view('games.show', compact('game', 'coach', 'type', 'review', 'playersWithReviews', 'playersByLevel', 'levels'));
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (Auth::user()->role !== 'coach') {
            return redirect()->route('home')->with('error', 'Access denied. Only coaches can perform this action.');
        }
        $game = Game::findOrFail($id);
        $type = Type::findOrFail($game->type_id);
        $coach = User::findOrFail($game->coach_id);
        return view('games.edit_form', compact('game', 'type', 'coach'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'coach') {
            return redirect()->route('home')->with('error', 'Access denied. Only coaches can perform this action.');
        }
        $game = Game::findOrFail($id);
        if (Review::where('game_id', $game->id)->exists()) {
            return redirect()->route('games.show', ['id' => $game->id])
                ->with('error', 'Players have already submitted reviews. You are not allowed to change this.');    
        };
        $validate = $request->validate([
            'title' => 'required|min:20',
            'reviews_required' => 'required|numeric|min:1',
            'max_score' => 'required|numeric|min:1|max:100',
            'due_date' => 'required|date',
            'assign_type' => 'required|string|in:coach,player',
            'instructions' => 'required|string',
        ]);

        $game->title = $request->title;
        $game->instructions = $request->instructions;
        $game->reviews_required = $request->reviews_required;
        $game->max_score = $request->max_score;
        $game->due_date = $request->due_date;
        $game->assign_type = $request->assign_type;
        $game->save();
        if ($request->assign_type == 'coach') {
            return redirect()->route('home')->with('success', 'Game updated successfully!');
        } else {
            return redirect()->route('games.show', ['game' => $game->id])->with('success', 'Game updated successfully!');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (Auth::user()->role !== 'coach') {
            return redirect()->route('home')->with('error', 'Access denied. Only coaches can perform this action.');
        }
        $game = Game::find($id);
        if ($game) {
            foreach ($game->teams as $team) {
                $team->players()->detach();
            }
            $game->teams()->delete();
            $game->reviews()->delete();
            $game->delete();
            return redirect()->route('home')->with('success', 'Game deleted successfully.');
        } else {
            return redirect()->route('home')->with('error', 'Game not found.');
        }
    }
    public function rolecall(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role !== 'coach') {
            return redirect()->route('home')->with('error', 'Access denied.');
        }
        $game = Game::findOrFail($id);
        $user_id = $user->id;
        if (!$request->level_id) {
            return redirect()->route('games.choose_level', $game->id);
        }
        $level_id = $request->validate([
            'level_id' => 'exists:levels,id',
        ])['level_id'];
        $level = Level::findOrFail($level_id);

        if ($game->teams()->where('level_id', $level_id)->exists()) {
            return redirect()->route('games.show', $game->id);
        }
        $playersAssignedToTeams = $game->teams()->with('players')->get()->pluck('players.*.id')->flatten();
        
        $players = User::whereHas('enrolments.level', function ($query) use ($level_id) {
            $query->where('level_id', $level_id);
        })
        ->whereNotIn('id', $playersAssignedToTeams)
        ->where('role', 'player')->distinct()->orderBy('name')->get();

        $playerIds = $players->pluck('id');

        $otherPlayers = User::whereHas('enrolments', function ($query) use ($game) {
            $query->whereHas('level', function ($subQuery) use ($game) {
                $subQuery->where('type_id', $game->type_id);
            });
        })->where('role', 'player')->whereNotIn('id', $playerIds)->whereNotIn('id', $playersAssignedToTeams)->distinct()->orderBy('name')->get();

        return view('games.rolecall', compact('game', 'players', 'otherPlayers', 'level'));
    }
    
    public function choose_level($id)
    {
        $user = Auth::user();
        if ($user->role !== 'coach') {
            return redirect()->route('home')->with('error', 'Access denied.');
        }
        $game = Game::findOrFail($id);
        $coach_id = $user->id;
        $levels = Level::whereHas('enrolments', function($query) use ($coach_id, $game) {
            $query->where('user_id', $coach_id)->whereHas('level', function($levelQuery) use ($game) {
                $levelQuery->where('type_id', $game->type_id);
            });
        })->whereDoesntHave('teams', function ($query) use ($game) {
            $query->where('game_id', $game->id);})->get();

        if (!$levels) {
            return redirect()->route('home')->with('error', 'You are not teaching any levels.');
        }
        return view('games.choose_level', compact('levels', 'game'));
    }

    public function generate_teams(Request $request, $id)
    {

        $user = Auth::user();
        if ($user->role !== 'coach') {
            return redirect()->route('home')->with('error', 'Access denied.');
        }

        $game = Game::findOrFail($id);
        $validatedData = $request->validate([
            'players' => 'required|array',
            'level_id' => 'required|numeric|exists:levels,id',
        ]);

        $level_id = (int) $request->level_id;

        if (Team::where('game_id', $game->id)->where('level_id', $level_id)->exists()) {
            return redirect()->route('games.show', $game->id)->with('error', 'Teams for this level already exist.');
        }

        $selectedPlayers = array_merge($request->players, $request->additional_players ?? []);

        if (count($selectedPlayers) <= 5) {
            $teamModel = Team::create([
                'game_id' => $game->id,
                'level_id' => $level_id,
                'name' => 'Team 1',
            ]);

            foreach ($selectedPlayers as $playerId) {
                TeamPlayer::create([
                    'player_id' => $playerId->id,
                    'team_id' => $teamModel->id,
                ]);
            }
        } else {
            $previousWeekGame = Game::where('type_id', $game->type_id)
                ->where('created_at', '<', $game->created_at)
                ->latest('created_at')
                ->first();

            $previousReviewedPairs = [];

            if ($previousWeekGame) {
                $previousReviews = Review::where('game_id', $previousWeekGame->id)->get();
                $previousReviewedPairs = $previousReviews->map(function ($review) {
                    return ['reviewer_id' => $review->reviewer_id, 'reviewee_id' => $review->reviewee_id];
                })->groupBy('reviewer_id')
                ->map(function ($reviewed) {
                    return $reviewed->pluck('reviewee_id')->toArray();
                })->toArray();
            }

            $playerAlreadyInTeam = [];
            $teams = [];
            shuffle($selectedPlayers);
            $numberOfPlayers = count($selectedPlayers);
            $canDifferentiate = true;

            foreach ($previousReviewedPairs as $reviewerId => $reviewedPlayers) {
                if (count($reviewedPlayers) > $numberOfPlayers) {
                    $canDifferentiate = false;
                    break;
                }
            }
            if ($numberOfPlayers = 6) {
                $teams = array_chunk($selectedPlayers, 3);
            } else {
                $numTeamsOfFour = intdiv($numberOfPlayers, 4);
                $remainder = $numberOfPlayers % 4;
    
                if ($remainder == 3) {
                    $numTeamsOfThree = 1;
                } elseif ($remainder < 3) {
                    $numTeamsOfThree = 2;
                    $numTeamsOfFour--;
                } else {
                    $numTeamsOfThree = 0;
                }
    
                $teams = array_chunk(array_slice($selectedPlayers, 0, $numTeamsOfFour * 4), 4);
                if ($numTeamsOfThree > 0) {
                    $remainingPlayers = array_slice($selectedPlayers, $numTeamsOfFour * 4);
                    $additionalTeams = array_chunk($remainingPlayers, 3);
                    $teams = array_merge($teams, $additionalTeams);
                }
            }

            if ($canDifferentiate) {
                foreach ($teams as $teamIndex => $team) {
                    foreach ($team as $playerIndex => $playerId) {
                        foreach ($team as $otherPlayerId) {
                            if (isset($previousReviewedPairs[$playerId]) && in_array($otherPlayerId, $previousReviewedPairs[$playerId])) {
                                $team = array_diff($team, [$playerId]);
                            }
                        }
                    }
                }
            } else {
                foreach ($selectedPlayers as $playerId) {
                    $assigned = false;
                    foreach ($teams as &$team) {
                        $repeatedPlayers = 0;
                        foreach ($team as $teammateId) {
                            foreach ($previousTeams as $prevTeam) {
                                if (in_array($playerId, $prevTeam) && in_array($teammateId, $prevTeam)) {
                                    $repeatedPlayers++;
                                }
                            }
                        }
                        if ($repeatedPlayers == 0 || count($team) < 4) {
                            $team[] = $playerId;
                            $assigned = true;
                            break;
                        }
                    }
                    if (!$assigned) {
                        usort($teams, fn($a, $b) => count($a) - count($b));
                        $teams[0][] = $playerId;
                    }
                }
            }
            foreach ($teams as $index => $team) {
                $teamModel = Team::create([
                    'game_id' => $game->id,
                    'level_id' => $level_id,
                    'name' => 'Team ' . ($index + 1),
                ]);

                foreach ($team as $playerId) {
                    $teamModel->players()->attach($playerId);

                }
            }
        }

        return redirect()->route('games.show', $game->id)->with('success', 'Teams created successfully!');
    }


}
