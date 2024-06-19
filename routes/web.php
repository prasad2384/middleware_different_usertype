<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/register', [HomeController::class, 'register']);

Route::post('/login', [HomeController::class, 'login']);

Route::middleware(['IsAdmin'])->group(function () {
    Route::get('/admin_dashboard', [HomeController::class, 'adminpage']);
});

Route::middleware(['IsUser'])->group(function () {
    Route::get('/user_dashboard', [HomeController::class, 'userpage']);
});

Route::get('/logout', [HomeController::class, 'logout'])->middleware('IsAuth');
