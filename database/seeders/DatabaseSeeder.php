<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
         \App\Models\Classroom::factory(10)->create();
         \App\Models\Subject::factory(10)->create();

//        \App\Models\User::factory()->create([
//            'name' => 'parent',
//            'email' => 'parent@parent.com',
//            'password' => Hash::make('password'),
//        ]);
//        \App\Models\Classroom::create([
//            'name' => 'Class 1',
//            'status' => 'active',
//            'created_by' => 1,
//        ]);
//        \App\Models\Subject::create([
//            'name' => 'Mathematics',
//            'type' => 'theory',
//            'status' => 'active',
//            'created_by' => 1,
//        ]);
    }
}
