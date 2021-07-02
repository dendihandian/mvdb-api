<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\v1\MovieController;
use App\Http\Controllers\Api\v1\PersonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->middleware(['auth:api'])->group(function(){
    Route::prefix('movies')->group(function(){
        Route::get('/', [MovieController::class, 'index']);
        Route::post('/', [MovieController::class, 'store']);

        Route::prefix('{movieId}')->middleware(['find_movie'])->group( function(){
            Route::get('/', [MovieController::class, 'show']);
            Route::put('/', [MovieController::class, 'update']);
            Route::delete('/', [MovieController::class, 'destroy']);
        });
    });

    Route::prefix('people')->group(function(){
        Route::get('/', [PersonController::class, 'index']);
        Route::post('/', [PersonController::class, 'store']);

        Route::prefix('{personId}')->middleware(['find_person'])->group( function(){
            Route::get('/', [PersonController::class, 'show']);
            Route::put('/', [PersonController::class, 'update']);
            Route::delete('/', [PersonController::class, 'destroy']);
        });
    });
});

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::middleware('auth:api')->group(function () {
        Route::get('user', [AuthController::class, 'user']);
        Route::post('logout', [AuthController::class, 'logout']);
    });
});