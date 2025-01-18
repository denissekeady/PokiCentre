<?php

namespace App\Http\Controllers;
use App\Models\Game;
use App\Models\Review;
use App\Models\Type;
use App\Models\User;
use App\Models\PlayerScore;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


use Illuminate\Http\Request;

class UserController extends Controller
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
        $coach = Auth::user();

        $players = User::where('role', 'player')->with('enrolments')->paginate(10);

        $playersSorted = $players->sortBy(function($player) {
            return $player->enrolments->isNotEmpty(); 
        });

        $playersWithScores = $playersSorted->map(function($player) {
            $averageScore = PlayerScore::where('player_id', $player->id)->avg('score');
            $submittedReviewsCount = Review::where('reviewer_id', $player->id)->count();
            return [
                'player' => $player,
                'averageScore' => !is_null($averageScore) ? number_format($averageScore, 1) : 'No score',
                'submittedReviewsCount' => $submittedReviewsCount ?? 0,
            ];
        });

        return view('users.index', compact('playersWithScores', 'players'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $review = Review::where('game_id', $game->id)->get();
        return view('games.show', compact('game', 'type', 'coach', 'review'));
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
}
