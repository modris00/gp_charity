<?php

namespace Database\Seeders;

use App\Models\CampaignsServices;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampaignsServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CampaignsServices::factory(10)->create();
    }
}
