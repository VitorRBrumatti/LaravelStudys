<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegisterController::class, 'exec']);

Route::get('/test', [TestController::class, 'exec']);