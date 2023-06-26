<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CampaignOperations>
 */
class CampaignOperationsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "date"=> "2023-05-07",
            "description"=> "sari",
            "cost"=> 10,
            "cost_type"=> "Primary",
            "admin_id"=> 2,
            "campaign_id"=> 18,
            "service_id"=> 4,
            "created_at"=> "2023-05-07T17:49:13.000000Z",
            "updated_at"=> "2023-05-07T17:49:13.000000Z"
        ];
    }
}
