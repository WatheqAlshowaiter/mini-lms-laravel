<?php

use App\Models\User;
use App\Models\Course;

test('a teacher can have many courses taught', function () {
    $teacher = User::factory()->teacher()->create();
    Course::factory()->count(2)->create(['teacher_id' => $teacher->id]);

    expect($teacher->coursesTaught)
        ->toHaveCount(2)
        ->each(fn($course) => expect($course->value)->toBeInstanceOf(Course::class));
});

test('a student can be enrolled in many courses', function () {
     $student = User::factory()->create(['role' => 'student']);
     $courses = Course::factory()->count(3)->create();

     $student->coursesEnrolled()->attach($courses->pluck('id'));

     expect($student->coursesEnrolled)
         ->toHaveCount(3)
         ->each(fn ($course) => expect($course->value)->toBeInstanceOf(Course::class));
 });
