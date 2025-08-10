<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService
    ) {}

    public function user(Request $request): UserResource
    {
        return new UserResource($request->user());
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $result = $this->authService->register($request->validated());

        return (new AuthResource($result))->response()->setStatusCode(201);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $result = $this->authService->login($request->validated());

        return (new AuthResource($result))->response()->setStatusCode(201);
    }

    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request): Response
    {
        $user = $request->user();

        $this->authService->logout($user);

        return response()->noContent();
    }
}
