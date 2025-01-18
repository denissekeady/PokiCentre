<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Game;
use App\Models\User;
use App\Models\Enrolment;
use App\Models\Pokemon;
use App\Models\PlayerPokemon;
use Illuminate\Support\Str;


class PokemonController extends Controller
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
    public function show()
    {
        $user = auth()->user();
    
        $userPokemon = $user->playerpokemon()->latest()->first();

        if (!$userPokemon) {
            $basePokemons = Pokemon::whereIn('name', ['Squirtle', 'Charmander', 'Bulbasaur'])->get();
            return view('pokemons.store', compact('basePokemons', 'userPokemon'));
        } else {
            $availableEvolutions = Pokemon::where('evolution', $userPokemon->pokemon->evolution)
            ->where(function ($query) use ($userPokemon) {
                $query->where('level', '=', $userPokemon->pokemon->level)
                      ->where('name', 'like', '%-%');
            })
            ->orWhere(function ($query) use ($userPokemon) {
                $query->where('evolution', $userPokemon->pokemon->evolution)
                      ->where('level', '=', $userPokemon->pokemon->level + 1)
                      ->where('name', 'not like', '%-%');
            })->orderBy('level', 'asc')->get();
    
            return view('pokemons.store', compact('availableEvolutions', 'userPokemon'));
        }
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
    public function update(Request $request, $id)
    {
        $player = auth()->user();
        $pokemonId = $request->pokemon_id;

        $pokemon = Pokemon::findOrFail($pokemonId);

        if ($player->player_points < $pokemon->price) {
            return redirect()->route('pokemons.store')->with('error', 'You do not have enough points to purchase this Pokémon.');
        }

        $player->player_points -= $pokemon->price;
        $player->save();

        PlayerPokemon::create([
            'player_id' => $player->id,
            'pokemon_id' => $pokemonId,
        ]);

        return redirect()->route('pokemons.store')->with('success', 'You have successfully purchased the Pokémon!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function buyPokemon(Request $request)
    {
        $player = auth()->user();
        $pokemonId = $request->input('pokemon_id');
        $pokemon = Pokemon::findOrFail($pokemonId);

        if ($player->player_points < $pokemon->price) {
            return redirect()->back()->with('error', 'Not enough points to buy this Pokémon.');
        }
        
        if ($player->playerPokemon) {
            $player->playerPokemon()->delete();
        }
        $player->player_points -= $pokemon->price;
        $player->save();

        PlayerPokemon::create([
            'user_id' => $player->id,
            'pokemon_id' => $pokemon->id,
        ]);

        return redirect()->back()->with('success', 'You bought the Pokémon!');
    }
    public function visit()
    {
        $user = auth()->user();
        $background = asset('images/pokistore.jpg');
        $myPokemon = $user->playerPokemon ? $user->playerPokemon->pokemon : null;
        if ($myPokemon) {
            if ($myPokemon->evolution == 'Charmander') {
                if ($myPokemon->level == 1) {
                    $background = asset('images/charmanderbg1.jpg');
                } elseif ($myPokemon->level == 2) {
                    $background = asset('images/charmanderbg2.jpg');
                } elseif ($myPokemon->level == 3) {
                    $background = asset('images/charmanderbg3.jpg');
                }
            }
            elseif ($myPokemon->evolution == 'Bulbasaur') {
                if ($myPokemon->level == 1) {
                    $background = asset('images/bulbasaurbg1.jpg');
                } elseif ($myPokemon->level == 2) {
                    $background = asset('images/bulbasaurbg2.jpg');
                } elseif ($myPokemon->level == 3) {
                    $background = asset('images/bulbasaurbg3.jpg');
                }
            }
            elseif ($myPokemon->evolution == 'Squirtle') {
                if ($myPokemon->level == 1) {
                    $background = asset('images/squirtlebg1.jpg');
                } elseif ($myPokemon->level == 2) {
                    $background = asset('images/squirtlebg2.jpg');
                } elseif ($myPokemon->level == 3) {
                    $background = asset('images/squirtlebg3.jpg');
                }
            }
            $pokemonName = Str::before($myPokemon->name, '-');
            
            return view('pokemons.visit', compact('myPokemon', 'background', 'pokemonName'));
        } else {
            return redirect()->route('pokemons.store');
        }
    }
}
