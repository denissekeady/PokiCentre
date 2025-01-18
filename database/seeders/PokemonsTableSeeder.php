<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PokemonsTableSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        DB::table('pokemons')->insert([
            'name' => 'Charmander',
            'evolution' => 'Charmander',
            'level' => 1,
            'price' => 5,
            'image' => 'images/pokemons/charmander.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Charmander-withBow',
            'evolution' => 'Charmander',
            'level' => 1,
            'price' => 10,
            'image' => 'images/pokemons/coquettecharmander.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Charmander-withHat',
            'evolution' => 'Charmander',
            'level' => 1,
            'price' => 10,
            'image' => 'images/pokemons/mafiacharmander.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Charmander-withCrown',
            'evolution' => 'Charmander',
            'level' => 1,
            'price' => 10,
            'image' => 'images/pokemons/kingcharmander.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Charmeleon',
            'evolution' => 'Charmander',
            'level' => 2,
            'price' => 5,
            'image' => 'images/pokemons/charmeleon.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Charmeleon-WithBow',
            'evolution' => 'Charmander',
            'level' => 2,
            'price' => 10,
            'image' => 'images/pokemons/coquettecharmeleon.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Charmeleon-WithHat',
            'evolution' => 'Charmander',
            'level' => 2,
            'price' => 10,
            'image' => 'images/pokemons/mafiacharmeleon.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Charmeleon-WithCrown',
            'evolution' => 'Charmander',
            'level' => 2,
            'price' => 10,
            'image' => 'images/pokemons/kingcharmeleon.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Charizard',
            'evolution' => 'Charmander',
            'level' => 3,
            'price' => 10,
            'image' => 'images/pokemons/charizard.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Charizard-withBow',
            'evolution' => 'Charmander',
            'level' => 3,
            'price' => 10,
            'image' => 'images/pokemons/coquettecharizard.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Charizard-withHat',
            'evolution' => 'Charmander',
            'level' => 3,
            'price' => 10,
            'image' => 'images/pokemons/mafiacharizard.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Charizard-withCrown',
            'evolution' => 'Charmander',
            'level' => 3,
            'price' => 10,
            'image' => 'images/pokemons/kingcharizard.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Bulbasaur',
            'evolution' => 'Bulbasaur',
            'level' => 1,
            'price' => 5,
            'image' => 'images/pokemons/bulbasaur.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Bulbasaur-withBow',
            'evolution' => 'Bulbasaur',
            'level' => 1,
            'price' => 10,
            'image' => 'images/pokemons/coquettebulbasaur.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Bulbasaur-withHat',
            'evolution' => 'Bulbasaur',
            'level' => 1,
            'price' => 10,
            'image' => 'images/pokemons/mafiabulbasaur.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Bulbasaur-withCrown',
            'evolution' => 'Bulbasaur',
            'level' => 1,
            'price' => 10,
            'image' => 'images/pokemons/kingbulbasaur.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Ivysaur',
            'evolution' => 'Bulbasaur',
            'level' => 2,
            'price' => 5,
            'image' => 'images/pokemons/ivysaur.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Ivysaur-withBow',
            'evolution' => 'Bulbasaur',
            'level' => 2,
            'price' => 10,
            'image' => 'images/pokemons/coquetteivysaur.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Ivysaur-withHat',
            'evolution' => 'Bulbasaur',
            'level' => 2,
            'price' => 10,
            'image' => 'images/pokemons/mafiaivysaur.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Ivysaur-withCrown',
            'evolution' => 'Bulbasaur',
            'level' => 2,
            'price' => 10,
            'image' => 'images/pokemons/kingivysaur.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Venusaur',
            'evolution' => 'Bulbasaur',
            'level' => 3,
            'price' => 10,
            'image' => 'images/pokemons/venusaur.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Venusaur-withBow',
            'evolution' => 'Bulbasaur',
            'level' => 3,
            'price' => 10,
            'image' => 'images/pokemons/coquettevenusaur.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Venusaur-withHat',
            'evolution' => 'Bulbasaur',
            'level' => 3,
            'price' => 10,
            'image' => 'images/pokemons/mafiavenusaur.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Venusaur-withCrown',
            'evolution' => 'Bulbasaur',
            'level' => 3,
            'price' => 10,
            'image' => 'images/pokemons/kingvenusaur.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Squirtle',
            'evolution' => 'Squirtle',
            'level' => 1,
            'price' => 5,
            'image' => 'images/pokemons/squirtle.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Squirtle-withBow',
            'evolution' => 'Squirtle',
            'level' => 1,
            'price' => 10,
            'image' => 'images/pokemons/coquettesquirtle.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Squirtle-withHat',
            'evolution' => 'Squirtle',
            'level' => 1,
            'price' => 10,
            'image' => 'images/pokemons/mafiasquirtle.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Squirtle-withCrown',
            'evolution' => 'Squirtle',
            'level' => 1,
            'price' => 10,
            'image' => 'images/pokemons/kingsquirtle.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Wartortle',
            'evolution' => 'Squirtle',
            'level' => 2,
            'price' => 5,
            'image' => 'images/pokemons/wartortle.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Wartortle-withBow',
            'evolution' => 'Squirtle',
            'level' => 2,
            'price' => 10,
            'image' => 'images/pokemons/coquettewartortle.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Wartortle-withHat',
            'evolution' => 'Squirtle',
            'level' => 2,
            'price' => 10,
            'image' => 'images/pokemons/mafiawartortle.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Wartortle-withCrown',
            'evolution' => 'Squirtle',
            'level' => 2,
            'price' => 10,
            'image' => 'images/pokemons/kingwartortle.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Blastoise',
            'evolution' => 'Squirtle',
            'level' => 3,
            'price' => 10,
            'image' => 'images/pokemons/blastoise.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Blastoise-withBow',
            'evolution' => 'Squirtle',
            'level' => 3,
            'price' => 10,
            'image' => 'images/pokemons/coquetteblastoise.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Blastoise-withHat',
            'evolution' => 'Squirtle',
            'level' => 3,
            'price' => 10,
            'image' => 'images/pokemons/mafiablastoise.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pokemons')->insert([
            'name' => 'Blastoise-withCrown',
            'evolution' => 'Squirtle',
            'level' => 3,
            'price' => 10,
            'image' => 'images/pokemons/kingblastoise.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
    }
}
