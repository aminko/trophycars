<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class User extends Model
{
    use HasFactory;

    protected $fillable = ["name", "cash"];

    public function vehicles()
    {
        return $this->belongsToMany(
            Vehicle::class,
            "user_vehicle",
            "user_id",
            "vehicle_id",
        )->withPivot("purchased_at");
    }

    public function hasVehicle(int $vehicleId): bool
    {
        return $this->vehicles()->where("vehicle_id", $vehicleId)->exists();
    }

    public function canAffordVehicle(Vehicle $vehicle): bool
    {
        return $this->cash >= $vehicle->price;
    }

    public function deductFromBalance(int $amount): void
    {
        $this->cash -= $amount;
        $this->save();
    }
}
