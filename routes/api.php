<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\RoleController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('role/get-all', [RoleController::class, 'getAll']);
Route::post('role/create', [RoleController::class, 'create']);
Route::post('role/update', [RoleController::class, 'update']);