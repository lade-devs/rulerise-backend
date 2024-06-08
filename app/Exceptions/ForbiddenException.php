<?php

namespace App\Exceptions;

use App\Support\ApiReturnResponse;
use Exception;

class ForbiddenException extends Exception
{
    public function __construct($message = "You do not have permission to access this resource.")
    {
        parent::__construct($message, 403);
    }

    public function render()
    {
        return ApiReturnResponse::forbidden();
    }
}
