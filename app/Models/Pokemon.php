<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;
    protected $table = 'pokemons';
    function playerpokemon() {
        return $this->hasMany('App\Models\PlayerPokemon');
    }
    public function evolutions() {
        return $this->hasMany(Pokemon::class, 'evolution', 'evolution');
    }
    public function players()
    {
        return $this->belongsToMany(User::class, 'player_pokemon');
    }
}
