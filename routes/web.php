<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\GptController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisionModeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category/{category}', [AdController::class, 'category'])->name('category.index');

Route::get("/search", [GptController::class, "search"])->name("ad.search");

Route::get('/detail/{ad}', [AdController::class, 'detail'])->name('ad.detail');
Route::get('/toggle-vision-mode', [VisionModeController::class, 'change'])->name('vision.mode');
Route::view('about', 'about')->name('about');
Route::get("/user/{user}", [HomeController::class, "user_profile"])->name("user.profile");

Route::middleware('guest')->group(function (){
   Route::get('login', [AuthController::class, 'login'])->name('login');
   Route::post('login', [AuthController::class, 'login_submit'])->name('login_submit');
   Route::get('register', [AuthController::class, 'register'])->name('register');
   Route::post('register', [AuthController::class, 'register_submit'])->name('register_submit');
});

Route::middleware('auth')->group(function (){
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::view('verify','auth.verify')->name('verify');
    Route::post('verify', [AuthController::class, 'check_verify'])->name('check_verify');
    Route::get('profile', [HomeController::class, 'profile'])->name('profile');

    Route::post('add_favorite/{ad}', [AdController::class, 'add_favorite'])->name('favorite.add');
    Route::post('delete_favorite/{ad}', [AdController::class, 'delete_favorite'])->name('favorite.delete');

    Route::post('delete_ad/{ad}', [AdController::class, 'delete'])->name('ad.delete');

    Route::get('archive', [AdController::class, 'archive'])->name('ad.archive');
    Route::post('unarchive/{ad}', [AdController::class, 'unarchive'])->name('ad.unarchive')->withTrashed();

    Route::get('add', [AdController::class, 'add_form'])->name('ad.add')->middleware('verified');
    Route::post('add', [AdController::class, 'add'])->name('ad.submit');

    Route::get("chats", [ChatController::class, "chats"])->name("chat.chats");
    Route::get("chat/{recepient}", [ChatController::class, "chat"])->name("chat.chat");
    Route::post("chat_submit/{chat}/{recepient}", [ChatController::class, "chat_submit"])->name("chat.submit");

    Route::post("text_edit", [GptController::class, "text_edit"])->name("text_edit");
    Route::post("grammar_edit", [GptController::class, "grammar_edit"])->name("grammar_edit");
});
