<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repository\Category\CategoryRepositoryInterface::class,
            \App\Repository\Category\CategoryRepository::class
        );
        $this->app->singleton(
            \App\Repository\Product\ProductRepositoryInterface::class,
            \App\Repository\Product\ProductRepository::class
        );
        $this->app->singleton(
            \App\Repository\Discount\DiscountCodeRepositoryInterface::class,
            \App\Repository\Discount\DiscountCodeRepository::class
        );
        $this->app->singleton(
            \App\Repository\User\UserRepositoryInterface::class,
            \App\Repository\User\UserRepository::class
        );
        $this->app->singleton(
            \App\Repository\Order\OrderRepositoryInterface::class,
            \App\Repository\Order\OrderRepository::class
        );
        $this->app->singleton(
            \App\Repository\OrderDetail\OrderDetailRepositoryInterface::class,
            \App\Repository\OrderDetail\OrderDetailRepository::class
        );
        $this->app->singleton(
            \App\Repository\ActivityHistory\ActivityHistoryRepositoryInterface::class,
            \App\Repository\ActivityHistory\ActivityHistoryRepository::class
        );
        
        $this->app->singleton(
            \App\Repository\Comment\CommentRepositoryInterface::class,
            \App\Repository\Comment\CommentRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
