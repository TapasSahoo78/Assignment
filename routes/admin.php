<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    AdminController,
    RolePermissionController
};


Route::group(['middleware' => ['auth', 'verified']], function () {

    Route::get('dashboard', function () {
        return view('admin.dashboard');
    });

    #Role Permission Related Routes
    Route::resource('roles', RolePermissionController::class);

    #Admin User Related Routes
    Route::resource('users', AdminController::class);
});
