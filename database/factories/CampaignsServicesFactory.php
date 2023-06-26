<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CampaignsServices>
 */
class CampaignsServicesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => 1.5,
            'description' => fake()->text(),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'status' => fake()->boolean(),
            'service_id' => 5,
            'campaign_id' => 3,
        ];
    }
}
