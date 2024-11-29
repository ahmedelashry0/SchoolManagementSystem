<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ClassSubject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\ClassSubject>
 */
final class ClassSubjectFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = ClassSubject::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'class_id' => \App\Models\Classroom::inrandomOrder()->first()->id,
            'subject_id' => \App\Models\Subject::inrandomOrder()->first()->id,
            'created_by' => \App\Models\User::inrandomOrder()->first()->id,
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
