<?php

namespace App\Providers;

use App\Infrastructure\DatabaseGetGameplayUser;
use App\Ports\GetGameplayUser;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        GetGameplayUser::class => DatabaseGetGameplayUser::class,
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
