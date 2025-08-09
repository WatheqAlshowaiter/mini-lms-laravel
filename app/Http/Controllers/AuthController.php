<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService
    ) {}

    public function user(Request $request)
    {
        return new UserResource($request->user());
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function register(RegisterRequest $request)
    {
        $result = $this->authService->register($request->validated());

        return (new AuthResource($result))->response()->setStatusCode(201);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(LoginRequest $request)
    {
        $result = $this->authService->login($request->validated());

        return (new AuthResource($result))->response()->setStatusCode(201);
    }

    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request): Response
    {
        $this->authService->logout($request);

        return response()->noContent();
    }
}
