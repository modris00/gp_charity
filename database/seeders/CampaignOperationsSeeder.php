<?php

namespace Database\Seeders;

use App\Models\CampaignOperations;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampaignOperationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        CampaignOperations::factory(50)->create();

    }
}
