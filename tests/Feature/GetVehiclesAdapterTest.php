<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetVehiclesAdapterTest extends TestCase
{
    use RefreshDatabase;

    public function testItShouldReturnVehicles()
    {
        $vehicles = Vehicle::factory()->count(10)->create();

        $response = $this->getJson("/api/v1/vehicles");

        $response->assertStatus(200);
        $response->assertJsonCount(10, "data");
        $response->assertJsonStructure([
            "data" => [["id", "name", "type", "price"]],
            "meta" => ["per_page", "count", "has_more"],
            "links" => ["next_page", "previous_page"],
        ]);
    }
}
