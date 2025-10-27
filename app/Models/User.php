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
}
