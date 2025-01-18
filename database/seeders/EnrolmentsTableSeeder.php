<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnrolmentsTableSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        DB::table('enrolments')->insert([
            'user_id' => 1,
            'level_id' => 1,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 2,
            'level_id' => 2,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 3,
            'level_id' => 3,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 4,
            'level_id' => 4,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 5,
            'level_id' => 5,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 6,
            'level_id' => 6,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 7,
            'level_id' => 7,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 8,
            'level_id' => 8,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 9,
            'level_id' => 9,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 2,
            'level_id' => 10,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 3,
            'level_id' => 11,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 9,
            'level_id' => 12,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 1,
            'level_id' => 13,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 7,
            'level_id' => 14,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 1,
            'level_id' => 15,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 10,
            'level_id' => 3,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 10,
            'level_id' => 9,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 10,
            'level_id' => 13,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 10,
            'level_id' => 12,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 11,
            'level_id' => 3,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 11,
            'level_id' => 9,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 11,
            'level_id' => 13,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 11,
            'level_id' => 12,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 12,
            'level_id' => 8,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 12,
            'level_id' => 12,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 12,
            'level_id' => 1,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 13,
            'level_id' => 2,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 13,
            'level_id' => 10,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 13,
            'level_id' => 15,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 14,
            'level_id' => 13,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 14,
            'level_id' => 5,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 15,
            'level_id' => 3,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 15,
            'level_id' => 6,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 15,
            'level_id' => 12,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 16,
            'level_id' => 2,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 16,
            'level_id' => 9,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 16,
            'level_id' => 14,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 17,
            'level_id' => 8,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 17,
            'level_id' => 15,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 18,
            'level_id' => 1,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 18,
            'level_id' => 9,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 18,
            'level_id' => 15,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 19,
            'level_id' => 4,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 19,
            'level_id' => 14,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 20,
            'level_id' => 11,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 21,
            'level_id' => 3,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 21,
            'level_id' => 12,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 21,
            'level_id' => 7,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 22,
            'level_id' => 13,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 22,
            'level_id' => 8,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 22,
            'level_id' => 4,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 23,
            'level_id' => 14,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 24,
            'level_id' => 15,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 25,
            'level_id' => 6,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 25,
            'level_id' => 8,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 26,
            'level_id' => 7,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 26,
            'level_id' => 13,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 27,
            'level_id' => 15,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 27,
            'level_id' => 1,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 27,
            'level_id' => 9,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 28,
            'level_id' => 3,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 28,
            'level_id' => 9,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 29,
            'level_id' => 4,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 29,
            'level_id' => 14,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 29,
            'level_id' => 10,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 30,
            'level_id' => 6,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 30,
            'level_id' => 2,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 30,
            'level_id' => 10,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 31,
            'level_id' => 10,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 32,
            'level_id' => 13,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 32,
            'level_id' => 5,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 33,
            'level_id' => 15,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 33,
            'level_id' => 8,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 34,
            'level_id' => 5,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 34,
            'level_id' => 13,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 35,
            'level_id' => 6,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 35,
            'level_id' => 14,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 36,
            'level_id' => 8,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 36,
            'level_id' => 15,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 36,
            'level_id' => 2,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('enrolments')->insert([
            'user_id' => 36,
            'level_id' => 4,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

    }
}


