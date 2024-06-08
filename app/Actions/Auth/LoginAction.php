<?php

namespace App\Actions\Auth;

class LoginAction
{
    public function execute(array $attributes) : ? string
    {
        if ( ! auth()->attempt($attributes) ) return null;

        // create access token, include ability based on role and return token
        $user = auth()->user();

        return $user->createToken('auth', [$user->role])->plainTextToken;
    }
}
