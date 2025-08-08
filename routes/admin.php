<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;

// Route::get('/', function () {
//     return view('admin.dashboard');
// });


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware(['auth:admin', 'check.banned.admin'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        // Category 
        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::get('categories/table', [CategoryController::class, 'table'])->name('categories.table');    
        Route::get('categories/options', [CategoryController::class, 'options'])->name('categories.options');

        // Admin Management
        Route::resource('admins', AdminController::class)->except(['show', 'destroy']);
        Route::post('admins/{id}/ban', [AdminController::class, 'ban'])->name('admins.ban');
        Route::post('admins/{id}/unban', [AdminController::class, 'unban'])->name('admins.unban');

        // User Management
        Route::resource('users', UserController::class)->except(['show', 'destroy']);
        Route::post('users/{id}/ban', [UserController::class, 'ban'])->name('users.ban');
        Route::post('users/{id}/unban', [UserController::class, 'unban'])->name('users.unban');
        Route::get('users/export', [UserController::class, 'export'])->name('users.export');

        // Post Management
        Route::resource('posts', PostController::class);
        Route::post('posts/{id}/approve', [PostController::class, 'approve'])->name('posts.approve');
        Route::post('posts/{id}/reject', [PostController::class, 'reject'])->name('posts.reject');

        // Role Management
        Route::resource('roles', RoleController::class)->except(['show']);
    });
});
