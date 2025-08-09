<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Session;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SessionFactory extends Factory
{
    protected $model = Session::class;

    public function definition(): array
    {
        return [
            'course_id' => Course::factory(),
            'title' => $this->faker->word(),
            'scheduled_at' => Carbon::now(),
            'duration_minutes' => $this->faker->numberBetween(1, 60),
        ];
    }
}
