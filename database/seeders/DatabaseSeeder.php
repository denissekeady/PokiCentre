<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(UsersTableSeeder::class);
        $this->call(TypesTableSeeder::class);
        $this->call(GamesTableSeeder::class);
        $this->call(LevelsTableSeeder::class);
        $this->call(EnrolmentsTableSeeder::class);
        $this->call(TeamsTableSeeder::class);
        $this->call(ReviewsTableSeeder::class);
        $this->call(PokemonsTableSeeder::class);
    }
}
