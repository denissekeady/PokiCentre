<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerPokemon extends Model
{
    use HasFactory;
    protected $table = 'player_pokemons';
    protected $fillable = ['user_id', 'pokemon_id'];
    function user() {
        return $this->belongsTo('App\Models\User');
    }
    function pokemon() {
        return $this->belongsTo('App\Models\Pokemon');
    }
}
