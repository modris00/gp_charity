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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string("cost");
            $table->string("image")->nullable();
            $table->text("description");

            $table->foreignId("campaign_id")->constrained()->restrictOnDelete()->restrictOnUpdate(); // FK
            $table->foreignId("supplier_id")->constrained()->restrictOnDelete()->restrictOnUpdate(); // FK
            $table->foreignId("currency_id")->constrained()->restrictOnDelete()->restrictOnUpdate(); // FK

            $table->unsignedBigInteger("campaign_service_id");
            $table->foreign("campaign_service_id")->references("id")->on("campaigns_services")->restrictOnDelete();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
