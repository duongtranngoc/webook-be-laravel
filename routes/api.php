<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\RoleController;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'role'], function () {
        Route::post('get-all', [RoleController::class, 'getAllRoles']);
        Route::post('create', [RoleController::class, 'addRole']);
        Route::post('update', [RoleController::class, 'editRole']);
        Route::post('detail', [RoleController::class, 'getRoleDetail']);
        Route::post('search', [RoleController::class, 'searchRoles']);
    });
});
