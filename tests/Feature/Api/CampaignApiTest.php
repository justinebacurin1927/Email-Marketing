<?php

namespace Tests\Feature\Api;

use App\Models\Campaign;
use App\Models\Contact;
use App\Models\MessageTemplate;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CampaignApiTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_can_list_campaigns()
    {
        Campaign::factory()->count(3)->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/campaigns');

        $response->assertOk()
            ->assertJsonStructure(['data', 'meta']);
    }

    public function test_can_create_campaign()
    {
        $template = MessageTemplate::factory()->create();
        $contact = Contact::factory()->create();
        $tag = Tag::factory()->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson('/api/campaigns', [
                'name' => 'Test Campaign',
                'template_id' => $template->id,
                'status' => 'draft',
                'contact_ids' => [$contact->id],
                'tag_ids' => [$tag->id],
            ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.name', 'Test Campaign');
    }

    public function test_can_show_campaign()
    {
        $campaign = Campaign::factory()->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson("/api/campaigns/{$campaign->id}");

        $response->assertOk()
            ->assertJsonPath('data.id', $campaign->id);
    }

    public function test_can_delete_campaign()
    {
        $campaign = Campaign::factory()->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->deleteJson("/api/campaigns/{$campaign->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('campaigns', ['id' => $campaign->id]);
    }

    public function test_can_filter_campaigns_by_status()
    {
        Campaign::factory()->create(['status' => 'sent']);
        Campaign::factory()->create(['status' => 'draft']);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/campaigns?status=sent');

        $response->assertOk();
        foreach ($response->json('data') as $campaign) {
            $this->assertEquals('sent', $campaign['status']);
        }
    }
}
