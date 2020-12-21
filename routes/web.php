<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\MessageController;

Route::get('/register', [AuthController::class, 'registerForm'])->name('register.show');
Route::get('/login', [AuthController::class, 'loginForm'])->name('login.show');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/messages', [MessageController::class, 'fetchMessages'])->middleware('auth');
Route::post('/messages', [MessageController::class, 'sendMessages'])->middleware('auth');


