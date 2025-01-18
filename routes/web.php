<?php

use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\BlogController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {

    $blogs = Blog::paginate(10);

    return view('frontend.index', compact('blogs'));
});


Route::get('blog/detail/{blog}', function ($slug) {
    $blog = Blog::where('slug', $slug)->first();

    return view('frontend.show', compact('blog'));
})->name('blog.detail');


Route::resource('users', UserController::class);
Route::get('users/{user}', [UserController::class, 'status'])->name('users.status');
Route::resource('blogs', BlogController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
