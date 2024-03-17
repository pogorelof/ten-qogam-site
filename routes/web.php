<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'index')->name('home');

Route::middleware('guest')->group(function (){
   Route::get('login', [AuthController::class, 'login'])->name('login_form');
   Route::post('login', [AuthController::class, 'login_submit'])->name('login_submit');
   Route::get('register', [AuthController::class, 'register'])->name('register_form');
   Route::post('register', [AuthController::class, 'register_submit'])->name('register_submit');
});

Route::middleware('auth')->group(function (){
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
