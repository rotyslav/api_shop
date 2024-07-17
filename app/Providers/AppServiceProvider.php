<?php

namespace App\Providers;

use App\Services\BasketService;
use App\Services\ProductService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(ProductService::class, ProductService::class);
        $this->app->bind(BasketService::class, BasketService::class);
    }
}
