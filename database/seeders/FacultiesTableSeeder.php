<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('faculties')->insert([
            ['name' => 'Computer Science'],
            ['name' => 'Mechanical Engineering'],
            ['name' => 'Electrical Engineering'],
            ['name' => 'Civil Engineering'],
            ['name' => 'Business Administration'],
            ['name' => 'Biotechnology'],
            ['name' => 'Information Technology'],
            ['name' => 'Architecture'],
        ]);
    }
}
