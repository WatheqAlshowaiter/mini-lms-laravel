<?php

namespace App\Services;

use App\Models\Course;
use App\Repositories\CourseRepository;

class CourseService
{
    public function __construct(
        protected CourseRepository $repo
    ) {}

    public function list()
    {
        return $this->repo->all();
    }

    public function show($id)
    {
        return $this->repo->find($id);
    }

    public function create(array $data)
    {
        return $this->repo->create($data);
    }

    public function update($id, array $data)
    {
        $course = Course::findOrFail($id);

        return $this->repo->update($course, $data);
    }

    public function delete($id)
    {
        $course = Course::findOrFail($id);

        return $this->repo->delete($course);
    }
}
