<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;
use App\Models\Game;
use App\Models\Type;
use App\Models\Level;

class TeamController extends Controller
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
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        $team = Team::findOrFail($id);
        $game = Game::findOrFail($team->game_id);
        $game_id = $game->id;
        $type_id = $game->type_id;

        $currentPlayers = $team->players;

        $smallTeams = Team::whereHas('players.enrolments.level', function ($query) use ($type_id) {
            $query->where('type_id', $type_id);
        })
        ->withCount('players')
        ->groupBy('teams.id')
        ->having('players_count', '<=', 2)
        ->pluck('id');
    
        $playersInSmallTeams = User::whereHas('teams', function ($query) use ($smallTeams) {
            $query->whereIn('team_id', $smallTeams);
        })
        ->whereDoesntHave('teams', function ($query) use ($smallTeams) {
            $query->whereNotIn('team_id', $smallTeams);
        })
        ->whereHas('enrolments.level', function ($query) use ($type_id) {
            $query->where('type_id', $type_id);
        })
        ->orderBy('name')->get();

        $game = $team->game;
        $availablePlayers = User::where('role', 'player')
            ->whereNotIn('id', $currentPlayers->pluck('id')) 
            ->whereHas('enrolments.level', function ($query) use ($type_id) {
                $query->where('type_id', $type_id);
            })
            ->orderBy('name')
            ->get();
        $allAvailablePlayers = $availablePlayers->unique('id')->sortBy('name');
        $level = $team->level;

        
        return view('teams.edit_form', compact('team', 'currentPlayers', 'availablePlayers', 'game', 'level'));
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
    public function addPlayer(Request $request, $team_id)
    {
        $validatedData = $request->validate([
            'player_id' => 'required|exists:users,id',
        ]);

        $team = Team::findOrFail($team_id);
        $player = User::findOrFail($validatedData['player_id']);

        if ($team->players->contains($player->id)) {
            return redirect()->back()->with('error', 'Player is already in the team.');
        }

        $player->teams()->detach();
        $team->players()->attach($player->id);

        return redirect()->back()->with('success', 'Player added to the team successfully.');
    }

    public function removePlayer(Request $request, $team_id, $player_id)
    {
        $team = Team::findOrFail($team_id);
        $player = User::findOrFail($player_id);

        $team->players()->detach($player->id);

        return redirect()->back()->with('success', 'Player removed from the team successfully.');
    }

    
}
