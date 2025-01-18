<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamPlayer extends Model
{
    use HasFactory;
    protected $fillable = ['team_id', 'player_id'];
    function player() {
        return $this->belongsTo('App\Models\User')->where('role', 'player');
    }
    function team() {
        return $this->belongsTo('App\Models\Team');
    }
}
