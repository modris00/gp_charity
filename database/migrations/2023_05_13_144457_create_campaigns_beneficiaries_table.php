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
        Schema::create('campaigns_beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->float('amount');
            $table->string('description');
            $table->enum('status' , ['finished', 'not_finished']);
            $table->foreignId("beneficiary_id")->constrained(); // FK
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
        Schema::dropIfExists('campaigns_beneficiaries');
    }
};
