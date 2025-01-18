<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerScore extends Model
{
    use HasFactory;
    protected $fillable = ['player_id', 'game_id', 'score'];
    function player() {
        return $this->belongsTo('App\Models\User', 'player_id');
    }
    function game() {
        return $this->belongsTo('App\Models\Game');
    }
}
