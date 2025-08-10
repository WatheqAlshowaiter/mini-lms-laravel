<?php

use App\Models\User;
use App\Models\Course;
use App\Models\Session;

it('a course belongs to a teacher', function () {
    $teacher = User::factory()->create(['role' => 'teacher']);
    $course = Course::factory()->create(['teacher_id' => $teacher->id]);

    expect($course->teacher)
        ->toBeInstanceOf(User::class)
        ->id->toBe($teacher->id);
});

it('a course can have many sessions', function () {
    $course = Course::factory()->create();
    Session::factory()->count(2)->create(['course_id' => $course->id]);

    expect($course->sessions)
        ->toHaveCount(2)
        ->each(fn($session) => expect($session->value)->toBeInstanceOf(Session::class));
});

it('a course can have many students', function () {
    $teacher = User::factory()->create(['role' => 'teacher']);
    $students = User::factory()->count(2)->create(['role' => 'student']);

    $course = Course::factory()->recycle($teacher)->create();

    $course->students()->attach($students->pluck('id'));

    expect($course->students)
        ->toHaveCount(2)
        ->each(fn($student) => expect($student->value)->toBeInstanceOf(User::class));

    $this->assertDatabaseCount('users', 3);

    $this->assertDatabaseCount('course_student', 2);
    $this->assertDatabaseHas('course_student', [
        'course_id' => $course->id,
        'student_id' => $students->first()->id,
    ]);
});
