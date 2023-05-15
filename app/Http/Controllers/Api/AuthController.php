<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\User\UserRepository;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(
        protected UserRepository $userRepository
    )
    {
    }

    public function login(LoginRequest $request):JsonResponse
    {
        $data = $this->userRepository->getAuth($request);

        return $data
            ? $this->json('Logged in successfully', $data)
            : $this->json('Failed to login! Invalid Credentials', null, 400);
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->userRepository->register($request);
    }
}
