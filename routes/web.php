<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'authenticateReverse.user'], function () {
    Route::get('/', [UserController::class, 'loginUserView'])->name('user.login');
    Route::post('/', [UserController::class, 'loginUser'])->name('user.login-auth');
    Route::get('/register', [UserController::class, 'registerUserView'])->name('user.register');
});

Route::group(['middleware' => 'authenticate.user'], function () {
    Route::get('/logout', [UserController::class, 'logOutUser'])->name('user.logout'); 
    Route::get('/activity', [ActivityController::class, 'getCurrentActivity'])->name('activity.activity');
    Route::post('/activity', [ActivityController::class, 'checkActivity'])->name('activity.activity-check');
    Route::get('/end', [ActivityController::class, 'endItinerary'])->name('activity.end');
});