<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CurrencyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'v1'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);

        Route::middleware(['log.requests'])->group(function () {
            Route::get('currencies', [CurrencyController::class, 'index']);
            Route::post('currencies', [CurrencyController::class, 'store']);
            Route::get('currencies/{currency}', [CurrencyController::class, 'show']);
            Route::put('currencies/{currency}', [CurrencyController::class, 'update']);
            Route::delete('currencies/{currency}', [CurrencyController::class, 'destroy']);
        });
    });
});
