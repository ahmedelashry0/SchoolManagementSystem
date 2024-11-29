<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Class_Subject_Timetable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Class_Subject_Timetable>
 */
final class Class_Subject_TimetableFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Class_Subject_Timetable::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'class_id' => \App\Models\Classroom::factory()->create()->id,
            'subject_id' => \App\Models\Subject::factory()->create()->id,
            'week_id' => rand(1, 7),
            'start_time' => fake()->time(),
            'end_time' => fake()->time(),
            'room_number' => fake()->randomNumber(3),
        ];
    }
}
