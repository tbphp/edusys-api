<?php

namespace App\Providers;

use App\Libs\ApiPaginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(LengthAwarePaginator::class, ApiPaginator::class);
        app('translator')->addNamespace('ratchet', resource_path('lang/askedio/ratchet'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
