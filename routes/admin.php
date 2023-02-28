<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    RolePermissionController
};


#Role Permission Related Routes
Route::resource('roles', RolePermissionController::class);
