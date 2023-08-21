<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Quotes\Providers\QuotesServiceProvider;
use Modules\Simpsons\Providers\SimpsonsServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(\Modules\Auth\Providers\AuthServiceProvider::class);
        $this->app->register(QuotesServiceProvider::class);
        $this->app->register(SimpsonsServiceProvider::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
