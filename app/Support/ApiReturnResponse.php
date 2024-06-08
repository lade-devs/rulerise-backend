<?php


namespace App\Support;


use Illuminate\Http\JsonResponse;

class ApiReturnResponse
{
    const UNAUTHORIZED = '401';
    const VALIDATION_ERROR = 'payloadValidationError';
    const SUCCESS = '200';
    const FAILED = '300';
    const NOT_FOUND = '302';

    private static function returnResponse(string $status, string $message, $data, $statusCode = null): JsonResponse
    {
        $statusCode = $statusCode ?? $status == self::UNAUTHORIZED ? 401 : 200;

        return response()->json([
            'status' => $status,
            'data' => $data,
            'message' => $message,
        ], $statusCode);
    }

    public static function unAuthorized(string $message = 'Unauthorized access'): JsonResponse
    {
        return self::returnResponse(self::UNAUTHORIZED, $message, []);
    }

    public static function forbidden(string $message = 'Unauthorized access'): JsonResponse
    {
        return self::returnResponse(self::UNAUTHORIZED, $message, [], 403);
    }

    public static function validationError(array $data, string $message = 'Validation error'): JsonResponse
    {
        return self::returnResponse(self::VALIDATION_ERROR, $message, $data);
    }

    public static function success( $data = [], string $message = 'Request processed successfully'): JsonResponse
    {
        return self::returnResponse(self::SUCCESS, $message, $data);
    }

    public static function failed(string $message = 'Failed to process request', array $data = []): JsonResponse
    {
        return self::returnResponse(self::FAILED, $message, $data);
    }

    public static function notFound(string $message = 'Does not exists', array $data = []): JsonResponse
    {
        return self::returnResponse(self::NOT_FOUND, $message, $data);
    }
}
