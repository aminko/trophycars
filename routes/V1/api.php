<?php
declare(strict_types=1);

use App\Http\V1\GetUserAdapter;
use App\Http\V1\GetVehiclesAdapter;
use App\Http\V1\PurchaseVehicleAdapter;
use Illuminate\Support\Facades\Route;

Route::prefix("v1")->group(function () {
    Route::get("/users/{id}", GetUserAdapter::class);
    Route::get("/vehicles", GetVehiclesAdapter::class);
    Route::post("/gamestore/vehicles", PurchaseVehicleAdapter::class);
});
