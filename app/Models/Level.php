<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Team;
use App\Models\Game;

class Level extends Model
{
    protected $fillable = ['level_code', 'name', 'description', 'type_id'];
    use HasFactory;
    function type() {
        return $this->belongsTo('App\Models\Type');
    }
    function enrolments() {
        return $this->hasMany('App\Models\Enrolment');
    }
    public function teams() {
        return $this->hasMany('App\Models\Team');
    }

}
