<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        return [
            'teacher_id' => User::factory()->teacher(),

            'title' => $this->faker->word(),
            'description' => $this->faker->text(),
        ];
    }
}
