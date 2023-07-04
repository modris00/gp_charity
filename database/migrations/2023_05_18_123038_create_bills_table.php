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

            $table->foreignId('campaign_id')
                ->nullable()
                ->constrained('campaigns')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreignId('supplier_id')
                ->nullable()
                ->constrained('suppliers')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreignId('currency_id')
                ->nullable()
                ->constrained('currencies')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreignId('campaign_service_id')
                ->nullable()
                ->constrained('campaigns_services')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->softDeletes();
            $table->timestamps();

            // $table->unsignedBigInteger("campaign_service_id");
            // $table->foreign("campaign_service_id")->references("id")->on("campaigns_services")->restrictOnDelete();
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
