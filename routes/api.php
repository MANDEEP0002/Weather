<?php

use App\Http\Controllers\WeatherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user/{city}',[WeatherController::class, 'we']);
Route::get('/user/{city}', [WeatherController::class, 'we'])->name('we');
