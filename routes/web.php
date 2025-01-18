<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Type;
use App\Models\Enrolment;
use App\Models\Game;
use App\Models\Team;
use App\Models\Review;
use App\Models\Level;
use App\Models\PlayerScore;
use App\Models\Pokemon;
use App\Models\PlayerPokemon;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\EnrolmentController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PlayerScoreController;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\PlayerPokemonController;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('app/home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/types/{type_code}', [TypeController::class, 'show'])->name('types.show');
    Route::resource('games', GameController::class);
    Route::resource('reviews', ReviewController::class);
    Route::post('/reviews/{game_id}/submit', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/player/{player_id}', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('/type/upload', [TypeController::class, 'create'])->name('types.upload_form');
    Route::post('/type/upload', [TypeController::class, 'store'])->name('types.store');
    Route::get('/players', [UserController::class, 'index'])->name('users.index');
    Route::post('/enrolment/{player_id}', [EnrolmentController::class, 'store'])->name('enrolment.store');
    Route::get('/level/{id}', [LevelController::class, 'show'])->name('levels.show');
    Route::get('games/{id}/rolecall', [GameController::class, 'rolecall'])->name('games.rolecall');
    Route::get('games/{id}/choose_level', [GameController::class, 'choose_level'])->name('games.choose_level');
    Route::post('games/{id}', [GameController::class, 'generate_teams'])->name('games.generate_teams');
    Route::post('/teams/{team_id}/add-player', [TeamController::class, 'addPlayer'])->name('teams.add_player');
    Route::delete('/teams/{team_id}/remove-player/{player_id}', [TeamController::class, 'removePlayer'])->name('teams.remove_player');
    Route::get('/team/{id}', [TeamController::class, 'edit'])->name('teams.edit_form');
    Route::post('/player/{id}', [PlayerScoreController::class, 'store'])->name('playerscore.store');
    Route::get('/reviews/{game_id}/rank', [ReviewController::class, 'rank_form'])->name('reviews.rank_form');
    Route::post('/reviews/{review_id}/rank', [ReviewController::class, 'rankReview'])->name('reviews.rank');
    Route::get('/pokemon/store', [PokemonController::class, 'show'])->name('pokemons.store');
    Route::post('/pokemon/buy/{pokemon}', [PokemonController::class, 'buyPokemon'])->name('pokemon.buy');
    Route::get('/pokemon/visit', [PokemonController::class, 'visit'])->name('pokemon.visit');
    
});

require __DIR__.'/auth.php';
