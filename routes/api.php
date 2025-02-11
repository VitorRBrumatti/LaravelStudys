<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegisterController::class, 'exec']);

Route::get('/test', [TestController::class, 'exec']);

Route::post('/verify', [VerificationController::class, 'verify']);