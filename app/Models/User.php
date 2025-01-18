<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function getAuthIdentifierName()
    {
        return 'gamer_id';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gamer_id',
        'role',
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // COACH RELATIONSHIPS
    function games() {
        return $this->hasMany('App\Models\Game', 'coach_id');
    }

    // PLAYER RELATIONSHIPS
    function enrolments() {
        return $this->hasMany('App\Models\Enrolment');
    }
    function reviewerreviews() {
        return $this->hasMany('App\Models\Review', 'reviewer_id');
    }
    function revieweereviews() {
        return $this->hasMany('App\Models\Review', 'reviewee_id');
    }
    function teamplayers() {
        return $this->hasMany('App\Models\TeamPlayer', 'player_id');
    }
    public function teams() {
        return $this->belongsToMany(Team::class, 'team_players', 'player_id', 'team_id');
    }
    function playerscores() {
        return $this->hasMany('App\Models\PlayerScore', 'player_id');
    }
    function playerpokemon() {
        return $this->hasOne(PlayerPokemon::class);;
    }

}
