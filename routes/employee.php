<?php

use App\Http\Controllers\Employee\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
            Route::get('/', 'index')->name('show');
            Route::put('update-photo', 'updatePhoto')->name('update.photo');
            Route::put('update-user', 'updateUser')->name('update.user');
            Route::put('update-profile', 'updateProfile')->name('update.profile');
            Route::put('update-address', 'updateAddress')->name('update.address');
            Route::put('update-password', 'updatePaaword')->name('update.password');
        });
    });
});
