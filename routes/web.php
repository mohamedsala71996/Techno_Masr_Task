<?php

use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\CommentController;



Route::middleware('track-site-visitor')->group(function () {

    // Authentication
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    Route::name('user.')->group(function () {

        // User Home (Posts List) - Accessible to everyone
        Route::get('/', [PostController::class, 'index'])->name('home');

        // Posts - Accessible to everyone
        Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');

        // Protected routes - require authentication and check for banned users
        Route::middleware(['auth', 'check.banned.user'])->group(function () {
            // Create Post
            Route::get('/posts-user/create', [PostController::class, 'create'])->name('posts.create');
            Route::post('/posts-user', [PostController::class, 'store'])->name('posts.store');

            // Profile
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
            Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

            // Comments
            Route::post('/posts-user/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
        });
    });
});
