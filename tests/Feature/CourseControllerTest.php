<?php

use App\Models\Course;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('can list courses', function () {
    Sanctum::actingAs(User::factory()->create());
    Course::factory()->count(3)->create();

    $response = $this->getJson(route('courses.index'));

    $response->assertOk()->assertJsonCount(3, 'data');

    $this->assertDatabaseCount('courses', 3);
});

test('can create a course', function () {
    $teacher = User::factory()->create(['role' => 'teacher']);
    Sanctum::actingAs($teacher);

    $response = $this->postJson(route('courses.store'), [
        'title' => 'New Course',
        'description' => 'A test course',
        'teacher_id' => $teacher->id,
    ]);

    $response->assertCreated()->assertJsonFragment([
        'title' => 'New Course',
        'description' => 'A test course',
    ]);

    $this->assertDatabaseHas('courses', [
        'title' => 'New Course',
        'description' => 'A test course',
        'teacher_id' => $teacher->id,
    ]);
});

test('can update a course', function () {
    $teacher = User::factory()->create(['role' => 'teacher']);
    Sanctum::actingAs($teacher);
    $course = Course::factory()->create(['teacher_id' => $teacher->id]);

    $response = $this->putJson(route('courses.update', $course), [
        'title' => 'Updated Course',
        'description' => $course->description,
        'teacher_id' => $teacher->id,
    ]);

    $response->assertOk()->assertJsonFragment([
        'title' => 'Updated Course',
        'description' => $course->description,
    ]);

    $this->assertDatabaseHas('courses', [
        'title' => 'Updated Course',
        'description' => $course->description,
        'teacher_id' => $teacher->id,
    ]);
});

test('can delete a course', function () {
    $teacher = User::factory()->create(['role' => 'teacher']);
    Sanctum::actingAs($teacher);
    $course = Course::factory()->create(['teacher_id' => $teacher->id]);

    $response = $this->deleteJson(route('courses.destroy', $course));

    $response->assertNoContent();

    $this->assertDatabaseMissing('courses', ['id' => $course->id]);
});
