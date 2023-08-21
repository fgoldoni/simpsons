<?php

namespace Modules\Quotes\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Quotes\Repositories\Contracts\QuotesRepository;
use Modules\Quotes\Repositories\Eloquent\EloquentQuotesRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->bind(QuotesRepository::class, EloquentQuotesRepository::class);
    }
}
