<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
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


/************** Register & Login Section Start ****************/
Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('custom-login', 'postLogin')->name('login.custom');
    Route::get('signout', 'signOut')->name('signout');
});
/************** Register & Login Section End ****************/
Route::controller(AuthController::class)->group(function () {
    Route::get('registration', 'registration')->name('registration');
    Route::post('user-registration', 'postRegistration')->name('register.post');

    Route::group(['middleware' => 'role:user'], function () {
        Route::get('user/dashboard', 'dashboard')->middleware(['auth', 'is_verify_email']);
        // Route::get('user/dashboard', 'dashboard');
    });
    // Route::get('user/dashboard', 'dashboard');
    Route::get('account/verify/{token}', 'verifyAccount')->name('user.verify');
});
