<?php

namespace Database\Seeders;

use App\Models\CampaignsBeneficiaries;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampaignsBeneficiariesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CampaignsBeneficiaries::factory(10)->create();
    }
}
