<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::get('login', [\App\Http\Controllers\Admin\AdminController::class, 'login'])->name('admin.login');
    Route::get('change-password', [\App\Http\Controllers\Admin\AdminController::class, 'changePassword'])->name('admin.change.password');
    Route::get('logout', [\App\Http\Controllers\Admin\AdminController::class, 'logout'])->name('admin.logout');
    Route::post('login', [\App\Http\Controllers\Admin\AdminController::class, 'postLogin'])->name('admin.post.login');


    Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.index');

    Route::prefix('category')->group(function () {
        Route::get('index', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('category.index');
        Route::get('add', [\App\Http\Controllers\Admin\CategoryController::class, 'add'])->name('category.add');
        Route::post('store', [\App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('category.store');
    });

    Route::prefix('product')->group(function () {
        Route::get('index', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('product.index');
    });

    Route::prefix('user')->group(function () {
        Route::get('index', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('user.index');
    });

    Route::prefix('order')->group(function () {
        Route::get('index', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('order.index');
    });

    Route::prefix('code')->group(function () {
        Route::get('index', [\App\Http\Controllers\Admin\CodeController::class, 'index'])->name('code.index');
    });


});
