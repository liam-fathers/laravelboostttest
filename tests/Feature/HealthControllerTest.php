<?php

namespace Tests\Feature;

use Tests\TestCase;

class HealthControllerTest extends TestCase
{
    /**
     * Test that the health endpoint returns ok status.
     */
    public function test_health_endpoint_returns_ok_status(): void
    {
        $response = $this->getJson('/api/health');

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'ok',
            ])
            ->assertJsonStructure([
                'status',
                'timestamp',
            ]);
    }

    /**
     * Test that the health endpoint returns a valid ISO 8601 timestamp.
     */
    public function test_health_endpoint_returns_valid_timestamp(): void
    {
        $response = $this->getJson('/api/health');
        $response->assertOk();
        
        $timestamp = $response->json('timestamp');

        $this->assertNotNull($timestamp);

        // Verify it's a valid ISO 8601 format
        $this->assertMatchesRegularExpression(
            '/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}/',
            $timestamp
        );
    }
}