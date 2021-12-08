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
            Route::get('index', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('category.index')->middleware(CheckRole::class);
            Route::get('add', [\App\Http\Controllers\Admin\CategoryController::class, 'add'])->name('category.add')->middleware(CheckRole::class);
            Route::get('edit/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('category.edit')->middleware(CheckRole::class);
            Route::get('delete/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('category.delete')->middleware(CheckRole::class);
            Route::post('store', [\App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('category.store')->middleware(CheckRole::class);
            Route::post('update/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('category.update')->middleware(CheckRole::class);
            Route::get('update-status/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'updateStatus'])->name('category.update.status')->middleware(CheckRole::class);
        });

        // san pham
        Route::prefix('product')->group(function () {
            Route::get('index', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('product.index');
            Route::get('add', [\App\Http\Controllers\Admin\ProductController::class, 'add'])->name('product.add');
            Route::get('edit/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('product.edit');
            Route::get('delete/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'delete'])->name('product.delete')->middleware(CheckRole::class);
            Route::post('store', [\App\Http\Controllers\Admin\ProductController::class, 'store'])->name('product.store');
            Route::post('update/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'update'])->name('product.update');
            Route::get('update-status/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'updateStatus'])->name('product.update.status');
            Route::get('comment', [\App\Http\Controllers\Admin\CommentController::class, 'index'])->name('product.comment');
            Route::get('delete-comment/{id}', [\App\Http\Controllers\Admin\CommentController::class, 'delete'])->name('product.comment.delete');
        });

        Route::prefix('user')->group(function () {
            Route::get('index', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('user.index')->middleware(CheckRole::class);
            Route::get('add', [\App\Http\Controllers\Admin\UserController::class, 'add'])->name('user.add')->middleware(CheckRole::class);
            Route::get('edit/{id}', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('user.edit')->middleware(CheckRole::class);
            Route::get('delete/{id}', [\App\Http\Controllers\Admin\UserController::class, 'delete'])->name('user.delete')->middleware(CheckRole::class);
            Route::get('reset-password/{id}', [\App\Http\Controllers\Admin\UserController::class, 'resetPassword'])->name('user.reset.password')->middleware(CheckRole::class);
            Route::post('store', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('user.store')->middleware(CheckRole::class);
            Route::post('update/{id}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('user.update')->middleware(CheckRole::class);
            Route::get('update-status/{id}', [\App\Http\Controllers\Admin\UserController::class, 'updateStatus'])->name('user.update.status')->middleware(CheckRole::class);
        });

        Route::prefix('activity-history')->group(function () {
            Route::get('index', [\App\Http\Controllers\Admin\ActivityHistory::class, 'index'])->name('history.index')->middleware(CheckRole::class);

            Route::get('detail/{id}', [\App\Http\Controllers\Admin\ActivityHistory::class, 'detail'])->name('history.detail')->middleware(CheckRole::class);
        });

        Route::prefix('order')->group(function () {
            Route::get('index', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('order.index');
            Route::get('detail/{order_code}', [\App\Http\Controllers\Admin\OrderController::class, 'detail'])->name('order.detail');
            Route::get('delete/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'delete'])->name('order.delete')->middleware(CheckRole::class);
            Route::post('update-status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('order.update.status');
        });

        //ma giam gia
        Route::prefix('code')->group(function () {
            Route::get('index', [\App\Http\Controllers\Admin\DiscountCodeController::class, 'index'])->name('code.index')->middleware(CheckRole::class);
            Route::get('add', [\App\Http\Controllers\Admin\DiscountCodeController::class, 'add'])->name('code.add')->middleware(CheckRole::class);
            Route::get('edit/{id}', [\App\Http\Controllers\Admin\DiscountCodeController::class, 'edit'])->name('code.edit')->middleware(CheckRole::class);
            Route::get('delete/{id}', [\App\Http\Controllers\Admin\DiscountCodeController::class, 'delete'])->name('code.delete')->middleware(CheckRole::class);
            Route::post('store', [\App\Http\Controllers\Admin\DiscountCodeController::class, 'store'])->name('code.store')->middleware(CheckRole::class);
            Route::post('update/{id}', [\App\Http\Controllers\Admin\DiscountCodeController::class, 'update'])->name('code.update')->middleware(CheckRole::class);
            Route::get('update-status/{id}', [\App\Http\Controllers\Admin\DiscountCodeController::class, 'updateStatus'])->name('code.update.status')->middleware(CheckRole::class);
        });
    });
});

Route::get('/', [\App\Http\Controllers\Users\HomeController::class, 'index']);
Route::get('index', [\App\Http\Controllers\Users\HomeController::class, 'index'])->name('users.index');
Route::get('product', [\App\Http\Controllers\Users\ProductController::class, 'index'])->name('users.product');
Route::get('product/{category}', [\App\Http\Controllers\Users\ProductController::class, 'getByCategory'])->name('users.product.category');
Route::get('product-detail/{slug}', [\App\Http\Controllers\Users\ProductController::class, 'detail'])->name('users.product.detail');
Route::get('checkout', [\App\Http\Controllers\Users\CheckoutController::class, 'index'])->name('users.checkout');
Route::post('comment', [\App\Http\Controllers\Users\ProductController::class, 'comment'])->name('users.product.comment');

Route::get('cart', [\App\Http\Controllers\Users\OrderController::class, 'cart'])->name('users.cart');
Route::post('add-to-cart', [\App\Http\Controllers\Users\OrderController::class, 'addToCart'])->name('users.add.cart');
Route::get('delete-product-cart/{id}', [\App\Http\Controllers\Users\OrderController::class, 'delProCart'])->name('users.del.cart');
Route::post('store-order', [\App\Http\Controllers\Users\OrderController::class, 'storeOrder'])->name('users.store.order');
Route::post('update-cart', [\App\Http\Controllers\Users\OrderController::class, 'updateCart'])->name('users.update.order');
