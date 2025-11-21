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

    /**
     * Test that show endpoint returns a single user by ID.
     */
    public function test_show_returns_single_user(): void
    {
        $user = User::factory()->create();

        $response = $this->getJson("/api/users/{$user->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]);
    }

    /**
     * Test that show endpoint returns 404 for non-existent user.
     */
    public function test_show_returns_404_for_non_existent_user(): void
    {
        $response = $this->getJson('/api/users/999');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Endpoint not found',
                'status' => 404,
            ]);
    }

    /**
     * Test that show endpoint does not expose sensitive fields.
     */
    public function test_show_does_not_expose_sensitive_fields(): void
    {
        $user = User::factory()->create();

        $response = $this->getJson("/api/users/{$user->id}");

        $this->assertArrayNotHasKey('password', $response->json());
        $this->assertArrayNotHasKey('remember_token', $response->json());
    }
}