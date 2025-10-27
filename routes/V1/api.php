<?php
declare(strict_types=1);

use App\Http\V1\GetUserAdapter;
use Illuminate\Support\Facades\Route;

Route::prefix("v1")->group(function () {
    Route::get("/users/{id}", GetUserAdapter::class);
});
