<?php

use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\BoardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login-social', [SocialLoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('boards')->group(function () {
        Route::get('/', [BoardController::class, 'index'])->name('index');
        Route::post('/store', [BoardController::class, 'store'])->name('store');
    });
});