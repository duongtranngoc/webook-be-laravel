<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\AdminAccountController;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'role'], function () {
        Route::post('get-all', [RoleController::class, 'getAllRoles']);
        Route::post('create', [RoleController::class, 'addRole']);
        Route::post('update', [RoleController::class, 'editRole']);
        Route::post('detail', [RoleController::class, 'getRoleDetail']);
        Route::post('search', [RoleController::class, 'searchRoles']);
    });

    Route::group(['prefix' => 'account'], function () {
        Route::post('get-all', [AdminAccountController::class, 'getAllAdminAccounts']);
        Route::post('create', [AdminAccountController::class, 'addAdminAccount']);
        Route::post('update', [AdminAccountController::class, 'editAdminAccount']);
        Route::post('detail', [AdminAccountController::class, 'getAdminAccountDetail']);
        Route::post('delete', [AdminAccountController::class, 'deleteAdminAccount']);
        Route::post('search', [AdminAccountController::class, 'searchAdminAccounts']);
    });
});
