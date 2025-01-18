<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Game;
use App\Models\User;
use App\Models\Enrolment;
use App\Models\Level;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;

class TypeController extends Controller
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
        if (Auth::user()->role !== 'coach') {
            return redirect()->route('home')->with('error', 'Access denied. Only coaches can perform this action.');
        }
        return view('types.upload_form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'coach') {
            return redirect()->route('home')->with('error', 'Access denied. Only coaches can perform this action.');
        }
        $request->validate([
            'type_file' => 'required|file|mimes:csv,txt',
        ]);

        $errors = [];

        $file = $request->file('type_file');
        $path = $file->getRealPath();

        DB::beginTransaction();

        try {
            $lines = file($path, FILE_IGNORE_NEW_LINES);

            foreach ($lines as $line) {
                $data = str_getcsv($line);

                if (count($data) < 7) {
                    $errors[] = "File format is incorrect. Ensure the necessary course details are included.";
                    throw new \Exception('Invalid file format');
                }

                if (isset($data[0], $data[1], $data[2], $data[3], $data[4], $data[5])) {
                    $typeCode = $data[0];
                    $typeName = $data[1];
                    $typeDescription = $data[2];
                    $levels = explode(';', $data[3]);
                    $coaches = explode(';', $data[4]);
                    $games = explode(';', $data[5]);
                    $players = explode(';', $data[6]);
                } else {
                    $errors[] = "File format is incorrect. Ensure the necessary fields are present.";
                    throw new \Exception('Missing fields');
                }
                $typecheck = Type::where('type_code', $typeCode)->first();
                if ($typecheck) {
                    $errors[] = "Type with code $typeCode already exists.";
                    throw new \Exception('Duplicate type code');
                } else {
                    // T Y P E   C R E A T E
                    $type = new Type();
                    $type->type_code = $typeCode;
                    $type->name = $typeName;
                    $type->description = $typeDescription;
                    $type->save();
                }


                // L E V E L   C R E A T E
                foreach ($levels as $level) {
                    $level_parts = explode(':', $level);
                    if (count($level_parts) < 3) {
                        $errors[] = "The level entry '$level' is missing required fields. Ensure it has the correct format.";
                        throw new \Exception('Invalid level format');
                    } 
                    [$level_code, $l_name, $l_description] = $level_parts;
                    $level = Level::create([
                            'level_code' => $level_code,
                            'name' => $l_name,
                            'description' => $l_description,
                            'type_id' => $type->id,
                        ]);
                }

                foreach ($coaches as $coach) {
                    $coach_parts = explode(':', $coach);
                    if (count($coach_parts) < 2) {
                        $errors[] = "The coach entry '$coach' is missing required fields. Ensure it has the correct format.";
                        throw new \Exception('Invalid coach format');
                    } 
                    [$coach_gamer_id, $c_level_code] = $coach_parts;
                    $coach = User::where('gamer_id', $coach_gamer_id)->where('role', 'coach')->first();
                    if (!$coach) {
                        $errors[] = "Coach with gamer_id $coach not found.";
                        throw new \Exception('Coach not found');
                    }
                    $level = Level::where('level_code', $c_level_code)->first();
                    if (!$level) {
                        $errors[] = "Level code $c_level_code does not exist.";
                        throw new \Exception('Level not found');
                    }
                    Enrolment::create([
                        'user_id' => $coach->id,
                        'level_id' => $level->id,
                    ]);
                
                }
                foreach ($games as $game) {
                    $gameParts = explode(':', $game);
                    if (count($gameParts) < 7) {
                        $errors[] = "The game entry '$game' is missing required fields. Ensure it has the correct format.";
                        throw new \Exception('Level not found');
                    }
                    [$title, $instructions, $reviews_required, $max_score, $due_date, $assign_type, $gc_gamer_id] = $gameParts;

                    $gameCoach = User::where('gamer_id', $gc_gamer_id)->where('role', 'coach')->first();
                    if (!$gameCoach) {
                        $errors[] = "Coach $gameCoach not found for the game $title.";
                        throw new \Exception('Level not found');
                    }
                    $game = Game::create(
                    [
                        'title' => $title,
                        'instructions' => $instructions,
                        'reviews_required' => $reviews_required,
                        'max_score' => $max_score,
                        'due_date' => $due_date,
                        'assign_type' => $assign_type,
                        'coach_id' => $gameCoach->id,
                        'type_id' => $type->id,
                    ]);
                }

                
                foreach ($players as $player) {
                    $player_parts = explode(':', $player);
                    if (count($player_parts) < 4) {
                        $errors[] = "The player entry '$player' is missing required fields. Ensure it has the correct format.";
                        throw new \Exception('Invalid player format');
                    }
                    [$gamerId, $name, $email, $p_level_code] = $player_parts;
                    $player = User::firstOrCreate(
                        ['gamer_id' => $gamerId],
                        [
                            'role' => 'player',
                            'name' => $name,
                            'email' => $email,
                            'password' => Hash::make('pokemon'),
                        ]
                    );
                    $level = Level::where('level_code', $p_level_code)->first();
                    if (!$level) {
                        $errors[] = "Level code $p_level_code does not exist.";
                        throw new \Exception('Player level not found');
                    }
                    Enrolment::create([
                        'user_id' => $player->id,
                        'level_id' => $level->id,
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('home')->with('success', 'Course created successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors($errors);
        }
    }


    
    /**
     * Display the specified resource.
     */
    public function show($type_code)
    {
        $type = Type::where('type_code', $type_code)->with(['games'])->firstOrFail();
        $levels = Level::where('type_id', $type->id)->get();
        $coaches = User::whereHas('enrolments', function ($query) use ($type) {
            $query->whereHas('level', function ($query) use ($type) {
                $query->where('type_id', $type->id);
            });
        })->where('role', 'coach')->distinct()->get();
        return view('types.show', compact('type', 'levels', 'coaches'));
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
