<?php

namespace Database\Factories;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamFactory extends Factory
{
    protected $model = Exam::class;

    public function definition(): array
    {
        return [

            'name' => $this->faker->name,
            'note' => $this->faker->sentence,
            'created_by' => User::where('user_type' ,'admin' )->inRandomOrder()->first()->id,
        ];
    }
}
