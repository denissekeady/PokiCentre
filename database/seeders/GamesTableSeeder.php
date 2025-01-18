<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GamesTableSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        DB::table('games')->insert([
            'title' => 'Attack Game 1 Reviews',
            'instructions' => 'Experts and veterans',
            'reviews_required' => 5,
            'max_score' => 5,
            'due_date' => '2024-01-01',
            'assign_type' => 'player',
            'coach_id' => 7,
            'type_id' => 1,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('games')->insert([
            'title' => 'Speedster Game 1 Reviews',
            'instructions' => 'Master and ultra',
            'reviews_required' => 5,
            'max_score' => 5,
            'due_date' => '2024-01-02',
            'assign_type' => 'player',
            'coach_id' => 7,
            'type_id' => 2,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('games')->insert([
            'title' => 'All-Rounder Game 1 Reviews',
            'instructions' => 'Beginner, unranked and great',
            'reviews_required' => 5,
            'max_score' => 5,
            'due_date' => '2024-01-03',
            'assign_type' => 'player',
            'coach_id' => 2,
            'type_id' => 3,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('games')->insert([
            'title' => 'Defender Game 1 Reviews',
            'instructions' => 'Master and ultra',
            'reviews_required' => 5,
            'max_score' => 5,
            'due_date' => '2024-01-04',
            'assign_type' => 'player',
            'coach_id' => 4,
            'type_id' => 4,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('games')->insert([
            'title' => 'Support Game 1 Reviews',
            'instructions' => 'Master and ultra',
            'reviews_required' => 5,
            'max_score' => 5,
            'due_date' => '2024-01-05',
            'assign_type' => 'player',
            'coach_id' => 1,
            'type_id' => 5,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('games')->insert([
            'title' => 'Attack Game 2 Reviews',
            'instructions' => 'Master Attack',
            'reviews_required' => 5,
            'max_score' => 5,
            'due_date' => '2024-01-07',
            'assign_type' => 'player',
            'coach_id' => 8,
            'type_id' => 1,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('games')->insert([
            'title' => 'Speedster Game 2 Reviews',
            'instructions' => 'Beginner, unranked and great',
            'reviews_required' => 5,
            'max_score' => 5,
            'due_date' => '2024-01-08',
            'assign_type' => 'player',
            'coach_id' => 9,
            'type_id' => 2,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('games')->insert([
            'title' => 'All-Rounder Game 2 Reviews',
            'instructions' => 'Master and ultra',
            'reviews_required' => 5,
            'max_score' => 5,
            'due_date' => '2024-01-09',
            'assign_type' => 'player',
            'coach_id' => 9,
            'type_id' => 3,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('games')->insert([
            'title' => 'Defender Game 2 Reviews',
            'instructions' => 'Master and ultra',
            'reviews_required' => 5,
            'max_score' => 5,
            'due_date' => '2024-01-10',
            'assign_type' => 'player',
            'coach_id' => 3,
            'type_id' => 4,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('games')->insert([
            'title' => 'Support Game 2 Reviews',
            'instructions' => 'Master and ultra',
            'reviews_required' => 5,
            'max_score' => 5,
            'due_date' => '2024-01-11',
            'assign_type' => 'player',
            'coach_id' => 4,
            'type_id' => 5,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('games')->insert([
            'title' => 'Attack Game 3 Reviews',
            'instructions' => 'Master Attack',
            'reviews_required' => 5,
            'max_score' => 5,
            'due_date' => '2024-02-14',
            'assign_type' => 'player',
            'coach_id' => 6,
            'type_id' => 1,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('games')->insert([
            'title' => 'Speedster Game 3 Reviews',
            'instructions' => 'Beginner, unranked and great',
            'reviews_required' => 5,
            'max_score' => 5,
            'due_date' => '2024-01-15',
            'assign_type' => 'player',
            'coach_id' => 3,
            'type_id' => 2,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('games')->insert([
            'title' => 'All-Rounder Game 3 Reviews',
            'instructions' => 'Master and ultra',
            'reviews_required' => 5,
            'max_score' => 5,
            'due_date' => '2024-01-16',
            'assign_type' => 'player',
            'coach_id' => 3,
            'type_id' => 3,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('games')->insert([
            'title' => 'Defender Game 3 Reviews',
            'instructions' => 'Master and ultra',
            'reviews_required' => 5,
            'max_score' => 5,
            'due_date' => '2024-01-17',
            'assign_type' => 'player',
            'coach_id' => 6,
            'type_id' => 4,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('games')->insert([
            'title' => 'Support Game 3 Reviews',
            'instructions' => 'Master and ultra',
            'reviews_required' => 5,
            'max_score' => 5,
            'due_date' => '2024-01-18',
            'assign_type' => 'player',
            'coach_id' => 1,
            'type_id' => 5,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
    }
}