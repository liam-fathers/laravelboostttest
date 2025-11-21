<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the users endpoint returns all users efficiently.
     */
    public function test_index_returns_all_users(): void
    {
        User::factory(5)->create();

        $response = $this->getJson('/api/users');

        $response->assertStatus(200)
            ->assertJsonCount(5);
    }

    /**
     * Test that password and sensitive fields are not exposed.
     */
    public function test_index_does_not_expose_sensitive_fields(): void
    {
        User::factory()->create();

        $response = $this->getJson('/api/users');

        $this->assertArrayNotHasKey('password', $response->json()[0]);
        $this->assertArrayNotHasKey('remember_token', $response->json()[0]);
    }

    /**
     * Test that the users endpoint returns empty array when no users exist.
     */
    public function test_index_returns_empty_array_when_no_users(): void
    {
        $response = $this->getJson('/api/users');

        $response->assertStatus(200)
            ->assertJson([]);
    }
}