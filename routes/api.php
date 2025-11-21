<?php

use Illuminate\Support\Facades\Route;

Route::get('/health', [App\Http\Controllers\HealthController::class, 'show'])->name('health.show');

Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
Route::get('/users/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');
