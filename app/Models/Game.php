<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $casts = [
        'due_date' => 'datetime'
    ];
    protected $fillable = ['title', 'instructions', 'reviews_required', 'max_score', 'due_date', 'assign_type', 'coach_id', 'type_id'];
    use HasFactory;
    function coach() {
        return $this->belongsTo('App\Models\User')->where('role', 'coach');
    }
    function type() {
        return $this->belongsTo('App\Models\Type');
    }
    function teams() {
        return $this->hasMany('App\Models\Team');
    }
    function reviews() {
        return $this->hasMany('App\Models\Review');
    }
    function playerscores() {
        return $this->hasMany('App\Models\PlayerScore');
    }
}
