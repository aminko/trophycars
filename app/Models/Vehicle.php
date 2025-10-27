<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ["name", "type", "price"];

    public function users()
    {
        return $this->belongsToMany(User::class, "user_vehicle")->withPivot(
            "purchased_at",
        );
    }
}
