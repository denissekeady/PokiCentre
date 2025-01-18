<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Sylvia Hayes',
            'email' => 'sylvia@pokemontrainer.com',
            'password' => Hash::make('trainer'),
            'gamer_id' => 'sylvia_sylveon',
            'role' => 'coach',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Harris Gibs',
            'email' => 'harris@pokemontrainer.com',
            'password' => Hash::make('trainer'),
            'gamer_id' => 'harry_pichu',
            'role' => 'coach',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Lara Washington',
            'email' => 'lara@pokemontrainer.com',
            'password' => Hash::make('trainer'),
            'gamer_id' => 'leafeonlara',
            'role' => 'coach',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Santiago Sloan',
            'email' => 'santiago@pokemontrainer.com',
            'password' => Hash::make('trainer'),
            'gamer_id' => 'sunnyspheal',
            'role' => 'coach',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Peggy Atkins',
            'email' => 'peggy@pokemontrainer.com',
            'password' => Hash::make('trainer'),
            'gamer_id' => 'peggyduck',
            'role' => 'coach',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Odessa Matthews',
            'email' => 'odessa@pokemontrainer.com',
            'password' => Hash::make('trainer'),
            'gamer_id' => 'oshawottodessa',
            'role' => 'coach',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Archie Meritt',
            'email' => 'archie@pokemontrainer.com',
            'password' => Hash::make('trainer'),
            'gamer_id' => 'archiearceus',
            'role' => 'coach',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Grant Barnes',
            'email' => 'grant@pokemontrainer.com',
            'password' => Hash::make('trainer'),
            'gamer_id' => 'geogrant',
            'role' => 'coach',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Raphael Kane',
            'email' => 'raphael@pokemontrainer.com',
            'password' => Hash::make('trainer'),
            'gamer_id' => 'raphaelraikou',
            'role' => 'coach',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Gerard Caldwell',
            'email' => 'gerard@pokemon.com',
            'password' => Hash::make('pokemon'),
            'gamer_id' => 'gerard_gloom',
            'role' => 'player',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Marcie Blackburn',
            'email' => 'marcie@pokemon.com',
            'password' => Hash::make('pokemon'),
            'gamer_id' => 'marcietwo',
            'role' => 'player',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Nathanael Clarke',
            'email' => 'nathanael@pokemon.com',
            'password' => Hash::make('pokemon'),
            'gamer_id' => 'ninjthanael',
            'role' => 'player',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Reinaldo Odonnell',
            'email' => 'Reinaldo@pokemon.com',
            'password' => Hash::make('pokemon'),
            'gamer_id' => 'reginaldo',
            'role' => 'player',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Percy Kirk',
            'email' => 'percy@pokemon.com',
            'password' => Hash::make('pokemon'),
            'gamer_id' => 'pokepercy',
            'role' => 'player',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Barton Horne',
            'email' => 'barton@pokemon.com',
            'password' => Hash::make('pokemon'),
            'gamer_id' => 'barbidoof',
            'role' => 'player',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Hayden Acevedo',
            'email' => 'hayden@pokemon.com',
            'password' => Hash::make('pokemon'),
            'gamer_id' => 'hoopahay',
            'role' => 'player',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Claudio Browning',
            'email' => 'claudio@pokemon.com',
            'password' => Hash::make('pokemon'),
            'gamer_id' => 'chariclaud',
            'role' => 'player',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Louie Ashley',
            'email' => 'louie@pokemon.com',
            'password' => Hash::make('pokemon'),
            'gamer_id' => 'lickylou',
            'role' => 'player',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Jodi Hensley',
            'email' => 'jodi@pokemon.com',
            'password' => Hash::make('pokemon'),
            'gamer_id' => 'jodiejynx',
            'role' => 'player',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Lola Mcpherson',
            'email' => 'lola@pokemon.com',
            'password' => Hash::make('pokemon'),
            'gamer_id' => 'lillilola',
            'role' => 'player',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Lloyd Wheeler',
            'email' => 'lloyd@pokemon.com',
            'password' => Hash::make('pokemon'),
            'gamer_id' => 'loydcario',
            'role' => 'player',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Moshe Kerr',
            'email' => 'moshe@pokemon.com',
            'password' => Hash::make('pokemon'),
            'gamer_id' => 'moshepod',
            'role' => 'player',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Dion York',
            'email' => 'dion@pokemon.com',
            'password' => Hash::make('pokemon'),
            'gamer_id' => 'dionite',
            'role' => 'player',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Carey Evans',
            'email' => 'carey@pokemon.com',
            'password' => Hash::make('pokemon'),
            'gamer_id' => 'careyquil',
            'role' => 'player',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Rita Dean',
            'email' => 'rita@pokemon.com',
            'password' => Hash::make('pokemon'),
            'gamer_id' => 'roseliarita',
            'role' => 'player',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Wilfred Newton',
            'email' => 'wilfred@pokemon.com',
            'password' => Hash::make('pokemon'),
            'gamer_id' => 'weepinwil',
            'role' => 'player',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Stewart Stevens',
            'email' => 'stewart@pokemon.com',
            'password' => Hash::make('pokemon'),
            'gamer_id' => 'stewrtle',
            'role' => 'player',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Linwood Kidd',
            'email' => 'linwood@pokemon.com',
            'password' => Hash::make('pokemon'),
            'gamer_id' => 'linray',
            'role' => 'player',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Tisha Bond',
            'email' => 'tisha@pokemon.com',
            'password' => Hash::make('pokemon'),
            'gamer_id' => 'tishaflame',
            'role' => 'player',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Jason Fisher',
            'email' => 'jason@pokemon.com',
            'password' => Hash::make('pokemon'),
            'gamer_id' => 'jigglyjason',
            'role' => 'player',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Tonia Hahn',
            'email' => 'tonia@pokemon.com',
            'password' => Hash::make('pokemon'),
            'gamer_id' => 'tonepi',
            'role' => 'player',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Calvin Salas',
            'email' => 'calvin@pokemon.com',
            'password' => Hash::make('pokemon'),
            'gamer_id' => 'clefcalvin',
            'role' => 'player',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Emery Blanchard',
            'email' => 'emery@pokemon.com',
            'password' => Hash::make('pokemon'),
            'gamer_id' => 'espeonemery',
            'role' => 'player',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Leta Aguirre',
            'email' => 'leta@pokemon.com',
            'password' => Hash::make('pokemon'),
            'gamer_id' => 'laprasleta',
            'role' => 'player',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Miranda Daugherty',
            'email' => 'miranda@pokemon.com',
            'password' => Hash::make('pokemon'),
            'gamer_id' => 'mewranda',
            'role' => 'player',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('users')->insert([
            'name' => 'Bernardo Chung',
            'email' => 'bernardo@pokemon.com',
            'password' => Hash::make('pokemon'),
            'gamer_id' => 'bulbanardo',
            'role' => 'player',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
    }
}
