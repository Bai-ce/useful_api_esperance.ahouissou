<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ShortLinkController;
use App\Http\Controllers\Api\ModuleController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/modules', [ModuleController::class, 'modules']);
    Route::post('/modules/{id}/activate', [ModuleController::class, 'activate']);
    Route::post('/modules/{id}/deactivate', [ModuleController::class, 'deactivate']);
});
Route::middleware(['auth:sanctum', 'checkModule'])->group(
    function () {
        Route::post('/shorten', [ShortLinkController::class, 'shorten']);
        Route::get('/s/{code}', [ShortLinkController::class, 'code']);
        Route::get('/links', [ShortLinkController::class, 'links']);
        Route::delete('/links/{id}', [ShortLinkController::class, 'delete']);
    }
);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
