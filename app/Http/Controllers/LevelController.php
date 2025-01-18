<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;
use App\Models\Enrolment;
use App\Models\User;

class LevelController extends Controller
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
    public function show($id)
    {
        $level = Level::findOrFail($id);
        $players = User::where('role', 'player')
            ->whereHas('enrolments', function ($query) use ($level) {
                $query->where('level_id', $level->id);
        })->orderBy('name')->get();
        $coach = User::where('role', 'coach')
            ->whereHas('enrolments', function ($query) use ($level) {
                $query->where('level_id', $level->id);
            })->first();

        return view('levels.show', compact('level', 'players', 'coach'));
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
