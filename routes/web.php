<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::get('login', [\App\Http\Controllers\Admin\AdminController::class, 'login'])->name('admin.login');
    Route::get('logout', [\App\Http\Controllers\Admin\AdminController::class, 'logout'])->name('admin.logout');
    Route::post('login', [\App\Http\Controllers\Admin\AdminController::class, 'postLogin'])->name('admin.post.login');


    Route::middleware(['auth'])->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.index');
        Route::get('change-password', [\App\Http\Controllers\Admin\AdminController::class, 'changePassword'])->name('admin.change.password');
        Route::post('change-password', [\App\Http\Controllers\Admin\AdminController::class, 'postChangePassword'])->name('admin.post.change.password');

        //danh muc san pham
        Route::prefix('category')->group(function () {
            Route::get('index', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('category.index');
            Route::get('add', [\App\Http\Controllers\Admin\CategoryController::class, 'add'])->name('category.add');
            Route::get('edit/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('category.edit');
            Route::get('delete/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('category.delete');
            Route::post('store', [\App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('category.store');
            Route::post('update/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('category.update');
            Route::get('update-status/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'updateStatus'])->name('category.update.status');
        });

        // san pham
        Route::prefix('product')->group(function () {
            Route::get('index', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('product.index');
            Route::get('add', [\App\Http\Controllers\Admin\ProductController::class, 'add'])->name('product.add');
            Route::get('edit/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('product.edit');
            Route::get('delete/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'delete'])->name('product.delete');
            Route::post('store', [\App\Http\Controllers\Admin\ProductController::class, 'store'])->name('product.store');
            Route::post('update/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'update'])->name('product.update');
            Route::get('update-status/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'updateStatus'])->name('product.update.status');
        });

        Route::prefix('user')->group(function () {
            Route::get('index', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('user.index');
        });

        Route::prefix('order')->group(function () {
            Route::get('index', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('order.index');
        });

        //ma giam gia
        Route::prefix('code')->group(function () {
            Route::get('index', [\App\Http\Controllers\Admin\DiscountCodeController::class, 'index'])->name('code.index');
            Route::get('add', [\App\Http\Controllers\Admin\DiscountCodeController::class, 'add'])->name('code.add');
            Route::get('edit/{id}', [\App\Http\Controllers\Admin\DiscountCodeController::class, 'edit'])->name('code.edit');
            Route::get('delete/{id}', [\App\Http\Controllers\Admin\DiscountCodeController::class, 'delete'])->name('code.delete');
            Route::post('store', [\App\Http\Controllers\Admin\DiscountCodeController::class, 'store'])->name('code.store');
            Route::post('update/{id}', [\App\Http\Controllers\Admin\DiscountCodeController::class, 'update'])->name('code.update');
            Route::get('update-status/{id}', [\App\Http\Controllers\Admin\DiscountCodeController::class, 'updateStatus'])->name('code.update.status');
        });
    });

});
