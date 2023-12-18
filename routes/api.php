<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\RoleController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('admin/role/get-all', [RoleController::class, 'getAll']);
Route::post('admin/role/create', [RoleController::class, 'create']);
Route::post('admin/role/update', [RoleController::class, 'update']);