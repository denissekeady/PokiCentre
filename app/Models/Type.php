<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $fillable = ['type_code', 'name', 'description'];
    function levels() {
        return $this->hasMany('App\Models\Level');
    }
    public function coaches()
    {
        return $this->hasManyThrough(
            'App\Models\User',  // The target model (User/Coach)
            'App\Models\Enrolment',  // The intermediate table (Enrolment)
            'level_id',  // Foreign key on the Enrolment table
            'id',  // Foreign key on the User (Coach) table
            'id',  // Local key on the Type (Course) table
            'user_id'  // Local key on the Enrolment table (referring to User)
        )->where('role', 'coach')->join('levels', 'enrolments.level_id', '=', 'levels.id')->where('levels.type_id', $this->id)->distinct();
    }
    public function players()
    {
        return $this->hasManyThrough(
            'App\Models\User',  // The target model (User/Coach)
            'App\Models\Enrolment',  // The intermediate table (Enrolment)
            'level_id',  // Foreign key on the Enrolment table
            'id',  // Foreign key on the User (Coach) table
            'id',  // Local key on the Type (Course) table
            'user_id'  // Local key on the Enrolment table (referring to User)
        )->where('role', 'player')->join('levels', 'enrolments.level_id', '=', 'levels.id')->where('levels.type_id', $this->id)->distinct();;
    }
    function games() {
        return $this->hasMany('App\Models\Game');
    }
}
