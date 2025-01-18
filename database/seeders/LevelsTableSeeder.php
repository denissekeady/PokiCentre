<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelsTableSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert([
            'level_code' => 'ATK001',
            'name' => 'Master Attack',
            'description' => 'This class is for those who are in the master and ultra ranks for attack and is looking to really refine their skills. This is not for light hearted, and you are expected to know how to play multiple pokemons by now.',
            'type_id' => 1,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('levels')->insert([
            'level_code' => 'ATK002',
            'name' => 'Expert Attack',
            'description' => 'This class is for those who are in the veteran and expert ranks for attack and is looking to really refine their skills. This is not for light hearted, and you are expected to know how to play multiple pokemons by now.',
            'type_id' => 1,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('levels')->insert([
            'level_code' => 'ATK003',
            'name' => 'Beginner Attack',
            'description' => 'This class is for those who are in the great and beginner ranks or unranked for attack and is looking to really refine their skills. This is not for light hearted, and you are expected to know how to play multiple pokemons by now.',
            'type_id' => 1,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('levels')->insert([
            'level_code' => 'SPD001',
            'name' => 'Master Speedster',
            'description' => 'This class is for those who are in the master and ultra ranks for speedster and is looking to really refine their skills. This is not for light hearted, and you are expected to know how to play multiple pokemons by now.',
            'type_id' => 2,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('levels')->insert([
            'level_code' => 'SPD002',
            'name' => 'Expert Speedster',
            'description' => 'This class is for those who are in the veteran and expert ranks for speedster and is looking to really refine their skills. This is not for light hearted, and you are expected to know how to play multiple pokemons by now.',
            'type_id' => 2,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('levels')->insert([
            'level_code' => 'SPD003',
            'name' => 'Beginner Speedster',
            'description' => 'This class is for those who are in the great and beginner ranks or unranked for speedster and is looking to really refine their skills. This is not for light hearted, and you are expected to know how to play multiple pokemons by now.',
            'type_id' => 2,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('levels')->insert([
            'level_code' => 'ALR001',
            'name' => 'Master All-Rounder',
            'description' => 'This class is for those who are in the master and ultra ranks for all-rounder and is looking to really refine their skills. This is not for light hearted, and you are expected to know how to play multiple pokemons by now.',
            'type_id' => 3,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('levels')->insert([
            'level_code' => 'ALR002',
            'name' => 'Expert All-Rounder',
            'description' => 'This class is for those who are in the veteran and expert ranks for all-rounder and is looking to really refine their skills. This is not for light hearted, and you are expected to know how to play multiple pokemons by now.',
            'type_id' => 3,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('levels')->insert([
            'level_code' => 'ALR003',
            'name' => 'Beginner All-Rounder',
            'description' => 'This class is for those who are in the great and beginner ranks and unranked for all-rounder and is looking to really refine their skills. This is not for light hearted, and you are expected to know how to play multiple pokemons by now.',
            'type_id' => 3,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('levels')->insert([
            'level_code' => 'DEF001',
            'name' => 'Master Defender',
            'description' => 'This class is for those who are in the master and ultra ranks for defender and is looking to really refine their skills. This is not for light hearted, and you are expected to know how to play multiple pokemons by now.',
            'type_id' => 4,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('levels')->insert([
            'level_code' => 'DEF002',
            'name' => 'Expert Defender',
            'description' => 'This class is for those who are in the veteran and expert ranks for defender and is looking to really refine their skills. This is not for light hearted, and you are expected to know how to play multiple pokemons by now.',
            'type_id' => 4,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('levels')->insert([
            'level_code' => 'DEF003',
            'name' => 'Beginner Defender',
            'description' => 'This class is for those who are in the great and beginner ranks and unranked for defender and is looking to really refine their skills. This is not for light hearted, and you are expected to know how to play multiple pokemons by now.',
            'type_id' => 4,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('levels')->insert([
            'level_code' => 'SPT001',
            'name' => 'Master Supporter',
            'description' => 'This class is for those who are in the master and ultra ranks for defender and is looking to really refine their skills. This is not for light hearted, and you are expected to know how to play multiple pokemons by now.',
            'type_id' => 5,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('levels')->insert([
            'level_code' => 'SPT002',
            'name' => 'Expert Supporter',
            'description' => 'This class is for those who are in the veteran and expert ranks for defender and is looking to really refine their skills. This is not for light hearted, and you are expected to know how to play multiple pokemons by now.',
            'type_id' => 5,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('levels')->insert([
            'level_code' => 'SPT003',
            'name' => 'Beginner Supporter',
            'description' => 'This class is for those who are in the great and beginner ranks and unranked for defender and is looking to really refine their skills. This is not for light hearted, and you are expected to know how to play multiple pokemons by now.',
            'type_id' => 5,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
    }
}
