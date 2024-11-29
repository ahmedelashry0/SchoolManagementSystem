<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Week;
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
         \App\Models\Classroom::factory(20)->create();
         \App\Models\Subject::factory(20)->create();
            \App\Models\ClassSubject::factory(20)->create();
            \App\Models\ClassTeacher::factory(20)->create();
            \App\Models\Class_Subject_Timetable::factory(20)->create();
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

//        Week::insert([
//            ['name' => 'Monday'],
//            ['name' => 'Tuesday'],
//            ['name' => 'Wednesday'],
//            ['name' => 'Thursday'],
//            ['name' => 'Friday'],
//            ['name' => 'Saturday'],
//            ['name' => 'Sunday'],
//        ]);
    }
}
