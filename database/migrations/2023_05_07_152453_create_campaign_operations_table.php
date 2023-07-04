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
        Schema::create('campaign_operations', function (Blueprint $table) {
            $table->id();
            $table->date("date");
            $table->mediumText("description");
            $table->float("cost");
            $table->enum("cost_type", ['Primary', 'Additional']);

            $table->foreignId('admin_id')
                ->nullable()
                ->constrained('admins')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreignId('campaign_id')
                ->nullable()
                ->constrained('campaigns')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreignId('service_id')
                ->nullable()
                ->constrained('services')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_operations');
    }
};
