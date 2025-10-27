<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetUserAdapterTest extends TestCase
{
    use RefreshDatabase;

    public function testItShouldReturn404WhenUserDoesNotExist()
    {
        $response = $this->getJson("/api/v1/users/1");

        $response->assertStatus(404);
    }

    public function testItShouldReturnUserWhenUserExists()
    {
        $user = User::factory()->count(1)->withId(5)->create()->first();

        $response = $this->getJson("/api/v1/users/{$user->id}");
        $response->assertStatus(200);
    }
}
