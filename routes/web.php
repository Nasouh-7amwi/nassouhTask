<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('home');

Route::get('/log', function () {
    return view('login', ['message' => 'You are already logged in from another device']);
})->name('log');

Route::get('/test', function () {
})->name('test')->middleware('loggedInStatus');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::prefix('Subscribers')->group(function () {
        Route::post('/create', [SubscriberController::class, 'create']);
        Route::post('/update/{subscriber_id}', [SubscriberController::class, 'update']);
        Route::get('/show/{subscriber_id}', [SubscriberController::class, 'show']);
        Route::get('/index', [SubscriberController::class, 'index']);
        Route::delete('/destroy/{subscriber_id}', [SubscriberController::class, 'destroy']);
        Route::get('/search', [SubscriberController::class, 'search']);
        Route::get('/subscribed/{subscriber_id}', [SubscriberController::class, 'subscribed']);
    });

    Route::prefix('Blogs')->group(function () {
        Route::post('/create', [BlogController::class, 'create']);
        Route::post('/update/{Blog_id}', [BlogController::class, 'update']);
        Route::get('/show/{Blog_id}', [BlogController::class, 'show']);
        Route::get('/index', [BlogController::class, 'index']);
        Route::delete('/destroy/{Blog_id}', [BlogController::class, 'destroy']);
        Route::get('/search', [BlogController::class, 'search']);
    });

    Route::get('/home2', [BlogController::class, 'index']);

});

