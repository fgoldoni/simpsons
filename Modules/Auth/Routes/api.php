<?php

Route::post('/auth/login', [\Modules\Auth\Http\Controllers\Api\AuthController::class, 'login'])
    ->middleware('api')
    ->name('auth.login');

Route::post('/auth/register', [\Modules\Auth\Http\Controllers\Api\AuthController::class, 'register'])
    ->middleware('api')
    ->name('auth.register');

Route::get('/auth/me', [\Modules\Auth\Http\Controllers\Api\AuthController::class, 'me'])
    ->middleware(['api', 'auth:api'])
    ->name('auth.me');
