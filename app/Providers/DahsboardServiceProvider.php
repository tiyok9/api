<?php

namespace App\Providers;

use App\Service\DashboardService;
use App\Service\Impl\DashboardServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class DahsboardServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(DashboardService::class,DashboardServiceImpl::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    public function provides(): array
    {
        return [DashboardService::class];
    }
}
