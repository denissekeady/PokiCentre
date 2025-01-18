<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrolment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'level_id'];
    function level() {
        return $this->belongsTo('App\Models\Level');
    }
    public function player() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
