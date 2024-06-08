<?php

namespace App\Http\Middleware;

use App\Support\ApiReturnResponse;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class ApiAuthMiddleware extends Middleware
{
    // To override default web landing page.
    protected function unauthenticated($request, array $guards)
    {
        ApiReturnResponse::unAuthorized()->send();
        die();
    }
}
