<?php

namespace App\Providers;

use App\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerLengthAwarePaginator();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }

    protected function registerLengthAwarePaginator(): void
    {
        $this->app->bind(
            LengthAwarePaginator::class,
            Paginator::class
        );
    }
}
