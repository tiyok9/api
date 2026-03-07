<?php

namespace App\Providers;

use App\Service\Impl\KaryawanServiceImpl;
use App\Service\KaryawanService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class KaryawanServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(KaryawanService::class,KaryawanServiceImpl::class);

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
        return [KaryawanService::class];
    }
}
