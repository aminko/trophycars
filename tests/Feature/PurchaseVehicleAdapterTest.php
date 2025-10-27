<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PurchaseVehicleAdapterTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanPurchaseVehicle()
    {
        $user = User::factory()->count(1)->create()->first();
        $vehicle = Vehicle::factory()
            ->create([
                "name" => "Tunderbird",
                "type" => "truck",
                "price" => 1000,
            ])
            ->first();

        $response = $this->post("api/v1/gamestore/vehicles", [
            "userId" => $user->id,
            "vehicleId" => $vehicle->id,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseCount("user_vehicle", 1);
        $this->assertDatabaseHas("user_vehicle", [
            "user_id" => $user->id,
            "vehicle_id" => $vehicle->id,
        ]);
    }

    public function testUserCannotPurchaseVehicleWithoutEnoughMoney()
    {
        $user = User::factory()->count(1)->withNoMoney()->create()->first();
        $vehicle = Vehicle::factory()
            ->create([
                "name" => "Tunderbird",
                "type" => "truck",
                "price" => 1000,
            ])
            ->first();

        $response = $this->post("api/v1/gamestore/vehicles", [
            "userId" => $user->id,
            "vehicleId" => $vehicle->id,
        ]);

        $response->assertStatus(422);
        $this->assertDatabaseCount("user_vehicle", 0);
        $this->assertDatabaseMissing("user_vehicle", [
            "user_id" => $user->id,
            "vehicle_id" => $vehicle->id,
        ]);
    }

    public function testItPreventsDuplicatePurchase()
    {
        $vehicle = Vehicle::factory()
            ->create([
                "name" => "Tunderbird",
                "type" => "truck",
                "price" => 1000,
            ])
            ->first();

        $user = User::factory()->count(1)->create()->first();
        $user->vehicles()->attach($vehicle->id, ["purchased_at" => now()]);

        $response = $this->post("api/v1/gamestore/vehicles", [
            "userId" => $user->id,
            "vehicleId" => $vehicle->id,
        ]);

        $response->assertStatus(409);
        $this->assertDatabaseCount("user_vehicle", 1);
        $this->assertDatabaseHas("user_vehicle", [
            "user_id" => $user->id,
            "vehicle_id" => $vehicle->id,
        ]);
    }
}
