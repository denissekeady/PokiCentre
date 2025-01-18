<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlayerScore;
use App\Models\Game;
use App\Models\User;

class PlayerScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, $id)
    {
        $request->validate([
            'game_id' => 'exists:games,id',
            'score' => 'required|numeric|min:0|max:100',
        ]);

        if (auth()->user()->role !== 'coach') {
            return redirect()->back()->with('error', 'Only coaches can assign scores.');
        }

        $game_id = $request->game_id;
        $score = $request->score;

        $player = User::findOrFail($id);
        $game = Game::findOrFail($game_id);

        PlayerScore::updateOrCreate(
            ['player_id' => $player->id, 'game_id' => $game->id],
            ['score' => $score,]
        );
        return redirect()->route('reviews.index', ['player_id' => $id])->with('success', 'Score assigned successfully!');

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
}
