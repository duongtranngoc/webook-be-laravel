<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\AdminAccountController;

use App\Http\Controllers\admin\AdminAuthController;
use App\Http\Controllers\user\UserAuthController;


Route::prefix('admin')->group(function () {
    Route::prefix('role')->group(function () {
        Route::post('get-all', [RoleController::class, 'getAllRoles']);
        Route::post('create', [RoleController::class, 'addRole']);
        Route::post('update', [RoleController::class, 'editRole']);
        Route::post('detail', [RoleController::class, 'getRoleDetail']);
        Route::post('search', [RoleController::class, 'searchRoles']);
    });

    Route::prefix('account')->group(function () {
        Route::post('get-all', [AdminAccountController::class, 'getAllAdminAccounts']);
        Route::post('create', [AdminAccountController::class, 'addAdminAccount']);
        Route::post('update', [AdminAccountController::class, 'editAdminAccount']);
        Route::post('detail', [AdminAccountController::class, 'getAdminAccountDetail']);
        Route::post('delete', [AdminAccountController::class, 'deleteAdminAccount']);
        Route::post('search', [AdminAccountController::class, 'searchAdminAccounts']);
    });

    Route::post('login', [AdminAuthController::class, 'loginAdminAccount']);
    Route::post('logout', [AdminAuthController::class, 'logoutAdminAccount']);
});

Route::group(['middleware' => 'auth:sanctum'], function () {
});

Route::post('user/login', [UserAuthController::class, 'loginUserAccount']);
Route::post('user/logout', [UserAuthController::class, 'logoutUserAccount']);