<?php

namespace App\Repositories\User;

use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Auth;

class UserRepository extends Repository
{
    public function model()
    {
        return User::class;
    }

    public function getAuth($request): bool|array
    {
        $credentials = [
            $this->username($request->input('username')) => $request->input('username'),
            'password' => $request->input('password')
        ];

        $attempt = Auth::attempt($credentials);

        if (!$attempt) {
            return false;
        }

        $user = Auth::user();

        return [
            'user' => new UserResource($user),
            'token' => $user->createToken($user->name)->accessToken
        ];
    }

    public function username(string $username): string
    {
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            return 'contact';
        }

        return 'username';
    }
}
