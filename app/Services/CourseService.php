<?php

namespace App\Services;

use App\Models\Course;
use App\Repositories\CourseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class CourseService
{
    public function __construct(
        protected CourseRepository $repo
    ) {}

    public function list(): LengthAwarePaginator
    {
        return $this->repo->all();
    }

    public function show(int|string $id): Course
    {
        return $this->repo->find($id);
    }

    public function create(array $data): Course
    {
        return $this->repo->create($data);
    }

    public function update(int|string $id, array $data): Course
    {
        $course = Course::findOrFail($id);

        return $this->repo->update($course, $data);
    }

    public function delete(int|string $id): bool
    {
        $course = Course::findOrFail($id);

        return $this->repo->delete($course);
    }
}
