<?php

use App\Models\Session;
use App\Models\Course;

it('a session belongs to a course', function () {
    Course::factory()->create();
    $course = Course::factory()->create();
    $session = Session::factory()->for($course)->create();

    expect($session->course)
        ->toBeInstanceOf(Course::class)
        ->id->toBe($course->id);
});
