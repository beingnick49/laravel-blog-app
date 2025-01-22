<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\BlogController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;


// Backend routes
Route::group(['middleware' => 'auth'], function () {

    // User and admin routes
    Route::resource('blogs', BlogController::class);

    // Admin routes
    Route::group(['middleware' => 'admin'], function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('users', UserController::class);
        Route::get('users/{user}/status', [UserController::class, 'status'])->name('users.status');
    });
});


// Authentication routes
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Frontend routes
Route::name('frontend.')->group(function () {
    Route::get('/', [FrontendBlogController::class, 'index'])->name('blogs.index');
    Route::get('{blog:slug}', [FrontendBlogController::class, 'show'])->name('blogs.show');
});