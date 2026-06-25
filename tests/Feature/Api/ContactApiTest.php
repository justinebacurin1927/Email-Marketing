<?php

namespace Tests\Feature\Api;

use App\Models\Contact;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactApiTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_can_list_contacts()
    {
        Contact::factory()->count(3)->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/contacts');

        $response->assertOk()
            ->assertJsonStructure(['data', 'meta']);
    }

    public function test_can_create_contact()
    {
        $tag = Tag::factory()->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson('/api/contacts', [
                'email' => 'test@example.com',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'tag_ids' => [$tag->id],
            ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.email', 'test@example.com');
    }

    public function test_can_show_contact()
    {
        $contact = Contact::factory()->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson("/api/contacts/{$contact->id}");

        $response->assertOk()
            ->assertJsonPath('data.id', $contact->id);
    }

    public function test_can_update_contact()
    {
        $contact = Contact::factory()->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->putJson("/api/contacts/{$contact->id}", [
                'first_name' => 'Updated',
            ]);

        $response->assertOk()
            ->assertJsonPath('data.first_name', 'Updated');
    }

    public function test_can_delete_contact()
    {
        $contact = Contact::factory()->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->deleteJson("/api/contacts/{$contact->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('contacts', ['id' => $contact->id]);
    }

    public function test_can_search_contacts()
    {
        Contact::factory()->create(['email' => 'unique@example.com']);
        Contact::factory()->count(3)->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/contacts?search=unique');

        $response->assertOk();
        $this->assertCount(1, $response->json('data'));
    }
}
