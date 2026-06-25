<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_dashboard_stats()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->getJson('/api/dashboard');

        $response->assertOk()
            ->assertJsonStructure(['stats', 'recent_campaigns', 'tags']);
    }

    public function test_dashboard_requires_authentication()
    {
        $response = $this->getJson('/api/dashboard');

        $response->assertStatus(401);
    }
}
