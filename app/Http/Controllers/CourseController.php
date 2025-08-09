<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Http\Resources\CourseResource;
use App\Services\CourseService;

class CourseController extends Controller
{
    public function __construct(
        protected CourseService $service
    ) {}

    public function index()
    {
        return CourseResource::collection($this->service->list());
    }

    public function store(CourseRequest $request)
    {
        $course = $this->service->create($request->validated());

        return new CourseResource($course);
    }

    public function show($id)
    {
        return new CourseResource($this->service->show($id));
    }

    public function update(CourseRequest $request, $id)
    {
        return new CourseResource($this->service->update($id, $request->validated()));
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        return response()->noContent();
    }
}
