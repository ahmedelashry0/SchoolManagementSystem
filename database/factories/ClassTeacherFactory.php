<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ClassTeacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\ClassTeacher>
 */
final class ClassTeacherFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = ClassTeacher::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'class_id' => \App\Models\Classroom::inRandomOrder()->first()->id,
            'teacher_id' => \App\Models\User::inRandomOrder()->first()->id,
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
