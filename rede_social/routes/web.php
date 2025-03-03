<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\WebsiteControllers\WebsiteController;



Route::get('/login', [WebsiteController::class, 'login']);
Route::get('/register', [WebsiteController::class, 'register']);

Route::get('/', [WebsiteController::class, 'home']);
Route::get('/home', [WebsiteController::class, 'home']);
Route::get('/user/{user_nickname}', [WebsiteController::class, 'user']);
Route::get('/post/{post_id}', [WebsiteController::class, 'post']);


/*

Route::middleware('auth')->get('/home', [WebsiteController::class, 'home']);
Route::middleware('auth')->get('/', [WebsiteController::class, 'home']);


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

*/