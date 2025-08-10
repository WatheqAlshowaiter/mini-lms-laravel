<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Http\Resources\CourseResource;
use App\Services\CourseService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CourseController extends Controller
{
    public function __construct(
        protected CourseService $service
    ) {}

    public function index(): AnonymousResourceCollection
    {
        return CourseResource::collection($this->service->list());
    }

    public function store(CourseRequest $request): CourseResource
    {
        $course = $this->service->create($request->validated());

        return new CourseResource($course);
    }

    public function show(int|string $id): CourseResource
    {
        return new CourseResource($this->service->show($id));
    }

    public function update(CourseRequest $request, int|string $id): CourseResource
    {
        return new CourseResource($this->service->update($id, $request->validated()));
    }

    public function destroy(int|string $id): Response
    {
        $this->service->delete($id);

        return response()->noContent();
    }
}
