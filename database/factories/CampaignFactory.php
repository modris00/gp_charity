<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campaign>
 */
class CampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'amount' => 1.5,
            'status' => fake()->randomElement(['Finished', 'Not Finished']),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'admin_id' => 5,
            'currency_id' => 3,
        ];
    }
}
