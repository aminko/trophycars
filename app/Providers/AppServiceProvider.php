<?php

namespace App\Providers;

use App\Infrastructure\DatabaseGetGameplayUser;
use App\Infrastructure\DatabaseGetVehicles;
use App\Ports\GetGameplayUser;
use App\Ports\GetVehicles;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        GetGameplayUser::class => DatabaseGetGameplayUser::class,
        GetVehicles::class => DatabaseGetVehicles::class,
    ];

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
        //
    }
}
