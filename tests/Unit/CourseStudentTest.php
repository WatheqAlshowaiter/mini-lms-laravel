<?php

use App\Models\CourseStudent;
use App\Models\Course;
use App\Models\User;

it('course_student pivot links course and student properly', function () {
    $student = User::factory()->create(['role' => 'student']);
    $course = Course::factory()->create();

    $pivot = CourseStudent::create([
        'course_id' => $course->id,
        'student_id' => $student->id,
    ]);

    expect($pivot->course)
        ->toBeInstanceOf(Course::class)
        ->id->toBe($course->id);

    expect($pivot->student)
        ->toBeInstanceOf(User::class)
        ->id->toBe($student->id);
});
