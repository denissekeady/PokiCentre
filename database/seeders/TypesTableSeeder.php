<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesTableSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            'type_code' => 'ATK',
            'name' => 'Attack Type',
            'description' => 'This is for those who want to learn and get betetr at attack type.',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('types')->insert([
            'type_code' => 'SPD',
            'name' => 'Speedster Type',
            'description' => 'This is for those who want to learn and get betetr at speedster type.',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('types')->insert([
            'type_code' => 'ALR',
            'name' => 'All-Rounder Type',
            'description' => 'This is for those who want to learn and get betetr at all-rounder type.',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('types')->insert([
            'type_code' => 'DEF',
            'name' => 'Defender Type',
            'description' => 'This is for those who want to learn and get betetr at defender type.',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('types')->insert([
            'type_code' => 'SPT',
            'name' => 'Support Type',
            'description' => 'This is for those who want to learn and get betetr at support type.',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
    }
}

