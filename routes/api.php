<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SampleAuthorizationController;
use Illuminate\Support\Facades\Route;


#product mgt endpoints
Route::prefix('product')->group(function () {
    Route::get('/', [ProductsController::class, 'index']);
    Route::post('/', [ProductsController::class, 'store']);
    Route::get('{productId}', [ProductsController::class, 'show']);
    Route::post('{productId}', [ProductsController::class, 'update']);
    Route::post('{productId}/delete', [ProductsController::class, 'delete']);
});

#login endpoint
Route::post('login', [AuthController::class, 'login']);

#authenticated endpoints
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::prefix('user')->group(function () {
        Route::get('asAdmin', [SampleAuthorizationController::class, 'asAdmin'])
            ->middleware(['ability:admin']);

        Route::get('asUser', [SampleAuthorizationController::class, 'asUser'])
            ->middleware(['ability:user']);
    });
});
