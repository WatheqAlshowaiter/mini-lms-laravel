<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->student()->create([
            'name' => 'Student',
            'email' => 'student@example.com',
        ]);

        $teacher = User::factory()->teacher()->create([
            'name' => 'Teacher',
            'email' => 'teacher@example.com',
        ]);

        Course::factory()->count(3)->for($teacher, 'teacher')->create();
    }
}
