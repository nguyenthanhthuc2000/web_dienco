<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(
            \App\Repository\Category\CategoryRepositoryInterface::class,
            \App\Repository\Category\CategoryRepository::class
        );
        $this->app->singleton(
            \App\Repository\Product\ProductRepositoryInterface::class,
            \App\Repository\Product\ProductRepository::class
        );
    }
}
