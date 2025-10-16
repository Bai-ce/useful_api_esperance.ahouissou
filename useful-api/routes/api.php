<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckModuleActive;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ModuleController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/modules', [ModuleController::class, 'modules']);
    Route::post('/modules/{id}/activate', [ModuleController::class, 'activate']);
    Route::post('/modules/{id}/deactivate', [ModuleController::class, 'deactivate']);
});
Route::middleware(['auth:sanctum'])->group(
    function () {
        Route::get('/modules/{id}', [ModuleController::class, 'modules']);
    }
);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
