<?php

namespace Database\Factories;

use App\Models\MessageTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

class CampaignFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3),
            'type' => 'regular',
            'status' => fake()->randomElement(['draft', 'scheduled', 'sent']),
            'send_date' => fake()->optional()->dateTimeBetween('now', '+1 month'),
            'template_id' => MessageTemplate::factory(),
            'contact_id' => null,
            'created_by' => 'Admin',
        ];
    }
}
