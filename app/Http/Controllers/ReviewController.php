<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Game;
use App\Models\User;
use App\Models\Type;
use App\Models\Enrolment;
use App\Models\Level;
use App\Models\PlayerScore;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($player_id)
    {
        $player = User::findOrFail($player_id);
        $levels = Level::whereDoesntHave('enrolments', function($query) use ($player) {
            $query->where('user_id', $player->id);
        })->with('type')->get();    
        $playerGames = $player->enrolments()->with(['level.type.games', 'level.type.games.reviews'])->paginate(1);

        $games = $player->enrolments()->with([
            'level.type.games' => function ($query) use ($player) {
                $query->with([
                    'reviews' => function ($reviewQuery) use ($player) {
                        $reviewQuery->where('reviewer_id', $player->id)
                                    ->orWhere('reviewee_id', $player->id);
                    },
                    'reviews.reviewer',
                    'reviews.reviewee'
                ]);
            }
        ])->paginate(1);
        $enrolments = $player->enrolments()->with('level')->with('level.type')->get();
        
        return view('reviews.index', compact('games', 'playerGames', 'player', 'levels', 'enrolments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $game_id)
    {     
        $game = Game::findOrFail($game_id);
        $user = Auth::user();

        $request->validate([
            'title' => 'required',
            'rating' => 'required|numeric|min:1|max:'. $game->max_score,
            'text' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (str_word_count($value) < 5) {
                        $fail('The '. $attribute .' must be at least 5 words.');
                    }
                }
            ],
            'reviewee_id' => 'required|exists:users,id',
            'team_id' => 'nullable|string'
        ]);
        if (Review::where('reviewer_id', $user->id)->where('game_id', $game_id)->where('reviewee_id', $request->reviewee_id)->exists()) {
            return back()->withErrors('You have already reviewed this playeer.');
        }
    
        $review = new Review();
        $review->reviewer_id = $user->id;
        $review->reviewee_id = $request->reviewee_id;
        $review->game_id = $game_id;
        $review->title = $request->title;
        $review->rating = $request->rating;
        $review->text = $request->text;
        $review->team_id = $request->team_id;
        $review->save();
    
        return redirect()->route('games.show', ['game' => $game->id])->with('success', 'Review submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function rank_form($game_id)
    {
        $player = auth()->user();
        $game = Game::findOrFail($game_id);

        if ($game->assign_type == "player") {
            $playersToRank = $game->reviews_required - 1;
        } elseif ($game->assign_type == "coach") {
            $team = Team::whereHas('players', function ($query) use ($player) {
                $query->where('player_id', $player->id);
            })->where('game_id', $game_id)->first();
            if (!$team) {
                return redirect()->back()->withErrors(['error' => 'Player is not assigned to a team for this game.']);
            }
            $teammatesCount = $team->teamplayers()->where('player_id', '!=', $player->id)->count();
            $playersToRank = $teammatesCount;
        }

        $reviews = Review::where('game_id', $game_id)
            ->where('reviewee_id', $player->id)
            ->whereNull('rank')
            ->with(['reviewer', 'reviewee'])
            ->limit($player->reviews_required)
            ->get();

        return view('reviews.rank_form', compact('reviews', 'player', 'game', 'playersToRank'));
    }

    public function rankReview(Request $request, $game_id)
    {
        {
            $ranks = $request->input('ranks');
        
            $uniqueRanks = array_unique(array_values($ranks));
            if (count($ranks) != count($uniqueRanks)) {
                return redirect()->back()->with('error', 'Duplicate ranks detected. Each review must have a unique rank.');
            }
    
            foreach ($ranks as $rank) {
                if ($rank < 1 || $rank > 5) {
                    return redirect()->back()->with('error', 'All ranks must be between 1 and 5.');
                }
            }
            foreach ($ranks as $reviewId => $rank) {
                $review = Review::findOrFail($reviewId);
        
                if ($review->rank) {
                    continue;
                }
                $review->rank = $rank;
                $review->save();

                $reviewee = User::find($review->reviewer_id);
                $points = $this->getPointsForRank($rank);
                $reviewee->player_points += $points;
                $reviewee->save();
            }
        
            return redirect()->route('games.show', ['game' => $game_id])->with('success', 'All reviews ranked successfully and points awarded!');
        }
    }

    protected function getPointsForRank($rank)
    {
        switch ($rank) {
            case 1:
                return 3;
            case 2:
                return 2.5;
            case 3:
                return 2;
            case 4:
                return 1.5;
            case 5:
                return 1;
            default:
                return 0;
        }
    }


}
