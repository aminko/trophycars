<?php

namespace App\Providers;

use App\Infrastructure\DatabaseGetGameplayUser;
use App\Infrastructure\DatabaseGetVehicles;
use App\Ports\GameplayStore;
use App\Ports\GetGameplayUser;
use App\Ports\GetVehicles;
use App\Services\GameplayStoreService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        GetGameplayUser::class => DatabaseGetGameplayUser::class,
        GetVehicles::class => DatabaseGetVehicles::class,
        GameplayStore::class => GameplayStoreService::class,
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
