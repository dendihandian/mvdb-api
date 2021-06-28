<?php

use App\Http\Controllers\Api\v1\MovieController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function(){
    Route::prefix('movies')->group(function(){
        Route::get('/', [MovieController::class, 'index']);
        Route::post('/', [MovieController::class, 'store']);

        Route::prefix('{movieId}')->middleware(['find_movie'])->group( function(){
            Route::get('/', [MovieController::class, 'show']);
            Route::put('/', [MovieController::class, 'update']);
            Route::delete('/', [MovieController::class, 'destroy']);
        });
    });
});

