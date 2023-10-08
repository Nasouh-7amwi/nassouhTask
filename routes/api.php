<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Http\Request;
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

Route::get('/login', [LoginController::class, 'login']);

Route::post('/register', [SubscriberController::class, 'create']);

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::prefix('Subscribers')->group(function () {
        Route::post('/create', [SubscriberController::class, 'create']);
        Route::post('/update/{subscriber_id}', [SubscriberController::class, 'update']);
        Route::get('/show/{subscriber_id}', [SubscriberController::class, 'show']);
        Route::get('/index', [SubscriberController::class, 'index']);
        Route::delete('/destroy/{subscriber_id}', [SubscriberController::class, 'destroy']);
        Route::get('/search', [SubscriberController::class, 'search']);
    });

    Route::prefix('Blogs')->group(function () {
        Route::post('/create', [BlogController::class, 'create']);
        Route::post('/update/{Blog_id}', [BlogController::class, 'update']);
        Route::get('/show/{Blog_id}', [BlogController::class, 'show']);
        Route::get('/index', [BlogController::class, 'indexApi']);
        Route::delete('/destroy/{Blog_id}', [BlogController::class, 'destroy']);
        Route::get('/search', [BlogController::class, 'search']);
    });

});



