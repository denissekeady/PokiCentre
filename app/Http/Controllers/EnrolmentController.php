<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrolment;
use App\Models\User;
use App\Models\Type;
use App\Models\Level;

class EnrolmentController extends Controller
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
    public function store(Request $request, $player_id)
    {
        if (auth()->user()->role !== 'coach') {
            return redirect()->back()->with('error', 'Only coaches can enroll players.');
        }

        $request->validate([
            'level_id' => 'required|exists:levels,id',
        ]);

        $player = User::where('id', $player_id)->where('role', 'player')->first();
        if (!$player) {
            return redirect()->back()->with('error', 'Player not found or not registered.');
        }

        $enrolled = Enrolment::where('user_id', $player->id)->where('level_id', $request->level_id)->exists();
        if ($enrolled) {
            return redirect()->back()->with('error', 'This player is already enrolled in this level.');
        }

        Enrolment::create([
            'user_id' => $player->id,
            'level_id' => $request->level_id,
        ]);

        return redirect()->route('reviews.index', ['player_id' => $player->id])->with('success', 'Player enrolled successfully.');
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
