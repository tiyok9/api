<?php

namespace App\Providers;

use App\Service\AbsensiService;
use App\Service\Impl\AbsensiServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class AbsensiServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(AbsensiService::class,AbsensiServiceImpl::class);

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
        return [AbsensiService::class];
    }
}
