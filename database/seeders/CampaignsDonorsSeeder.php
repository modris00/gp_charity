<?php

namespace Database\Seeders;

use App\Models\CampaignsDonors;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampaignsDonorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CampaignsDonors::factory(10)->create();

    }
}
