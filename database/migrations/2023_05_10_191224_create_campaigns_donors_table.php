<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('campaigns_donors', function (Blueprint $table) {
            $table->id();
            $table->float('amount');
            $table->foreignId("donor_id")->constrained(); // FK
            $table->foreignId("campaign_id")->constrained(); // FK
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns_donors');
    }
};
