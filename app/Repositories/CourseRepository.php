<?php

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Pagination\LengthAwarePaginator;

class CourseRepository
{
    public function all(): LengthAwarePaginator
    {
        return Course::with('teacher')->paginate(15);
    }

    public function find(int|string $id): Course
    {
        return Course::with('teacher')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Course::create($data);
    }

    public function update(Course $course, array $data)
    {
        $course->update($data);

        return $course;
    }

    public function delete(Course $course): ?bool
    {
        return $course->delete();
    }
}
