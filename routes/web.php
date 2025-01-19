<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\BlogController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;

// Admin routes
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::get('users/{user}', [UserController::class, 'status'])->name('users.status');
});

// User routes
Route::group(['middleware' => 'auth'], function () {
    Route::resource('blogs', BlogController::class);
});

// Authentication routes
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Frontend routes
Route::get('/', [FrontendBlogController::class, 'index'])->name('blog.index');
Route::get('{blog:slug}', [FrontendBlogController::class, 'show'])->name('blog.show');
