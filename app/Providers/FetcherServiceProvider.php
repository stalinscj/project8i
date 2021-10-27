<?php

namespace App\Providers;

use App\Services\FetcherService;
use Illuminate\Support\ServiceProvider;
use App\Services\Contracts\FetcherService as FetcherServiceContract;

class FetcherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FetcherServiceContract::class, FetcherService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
