<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ReviewLikeController;




Route::get('/', function(){
     return view('home');    
});
Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
Route::post('/logout',[LogoutController::class, 'store'])->name('logout');
Route::get('/login',[LoginController::class, 'index'])->name('login');
Route::post('/login',[LoginController::class, 'store']);

Route::get('/register',[RegisterController::class, 'index'])->name('register');
Route::post('/register',[RegisterController::class, 'store']);

Route::get('/reviews',[ReviewController::class, 'index'])->name('reviews');
Route::post('/reviews',[ReviewController::class, 'store']);
Route::delete('/reviews/{review}',[ReviewController::class, 'destroy'])->name('reviews.destroy');


Route::post('/reviews/{review}/likes',[ReviewLikeController::class, 'store'])->name('reviews.likes');
Route::delete('/reviews/{review}/likes',[ReviewLikeController::class, 'destroy'])->name('reviews.likes');


