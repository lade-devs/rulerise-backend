<?php

namespace App\Http\Controllers;

use App\Actions\Auth\LoginAction;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Support\ApiReturnResponse;
use Illuminate\Http\JsonResponse;

class AuthController
{
    public function login(LoginRequest $request) : JsonResponse
    {
        $token = (new LoginAction)->execute($request->only(['email', 'password']));

        return $token
            ? ApiReturnResponse::success(new UserResource(['token' => $token]))
            : ApiReturnResponse::failed('Wrong email or password');
    }
}
