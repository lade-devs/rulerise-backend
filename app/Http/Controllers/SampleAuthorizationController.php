<?php

namespace App\Http\Controllers;

use App\Support\ApiReturnResponse;
use Illuminate\Http\JsonResponse;

/**
 * This is sample controller to test basic authorization.
 */
class SampleAuthorizationController
{
    public function asAdmin() : JsonResponse
    {
        return ApiReturnResponse::success(message: 'Yay Admin Access');
    }

    public function asUser() : JsonResponse
    {
        return ApiReturnResponse::success(message:'Yay User Access');
    }
}
