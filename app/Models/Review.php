<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    function reviewer() {
        return $this->belongsTo('App\Models\User', 'reviewer_id')->where('role', 'player');
    }
    function reviewee() {
        return $this->belongsTo('App\Models\User', 'reviewee_id')->where('role', 'player');
    }
    function game() {
        return $this->belongsTo('App\Models\Game');
    }
    function team() {
        return $this->belongsTo('App\Models\Team');
    }
}
