<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MessageTemplateFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3),
            'subject' => fake()->sentence(5),
            'body' => fake()->paragraphs(3, true),
        ];
    }
}
