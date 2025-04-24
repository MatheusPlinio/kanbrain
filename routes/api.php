<?php

use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\ColumnController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login-social', [SocialLoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('boards')->group(function () {

        Route::get('/', [BoardController::class, 'index'])->name('index');
        Route::get('/show/{board:slug}', [BoardController::class, 'show'])->name('show');
        Route::post('/store', [BoardController::class, 'store'])->name('store');

        Route::prefix('columns')->group(function () {
            Route::post('/store/{board:slug}', [ColumnController::class, 'store'])->name('store');  

            Route::prefix('tasks')->group(function () {
                Route::get('/{column:id}', [TaskController::class, 'show'])->name('show');
            });
        });
    });
});