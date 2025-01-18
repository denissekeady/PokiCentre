<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'game_id', 'level_id'];
    function game() {
        return $this->belongsTo('App\Models\Game');
    }
    function reviews() {
        return $this->hasMany('App\Models\Review');
    }
    function teamplayers() {
        return $this->hasMany('App\Models\TeamPlayer');
    }
    public function players() {
        return $this->belongsToMany(User::class, 'team_players', 'team_id', 'player_id');
    }
    function level() {
        return $this->belongsTo('App\Models\Level');
    }

}
