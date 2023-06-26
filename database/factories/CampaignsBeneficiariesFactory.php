<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CampaignsBeneficiaries>
 */
class CampaignsBeneficiariesFactory extends Factory
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
            'description' => fake()->sentence(),
            'status' => 'finished',
            'beneficiary_id' =>1,
            'campaign_id' => 3,
        ];
    }
}
