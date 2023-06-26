<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CampaignImages>
 */
class CampaignImagesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => fake()->image(),
            'description' => fake()->sentence(),
            'active' => fake()->boolean(),
            'campaign_id' => 3,
        ];
    }
}
