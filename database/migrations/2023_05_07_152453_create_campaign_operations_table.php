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
            $table->enum("cost_type",['Primary','Additional']);
            $table->foreignId("admin_id")->constrained()->onDelete('RESTRICT');
            $table->foreignId("campaign_id")->constrained()->onDelete('RESTRICT');
            $table->foreignId("service_id")->constrained()->onDelete("RESTRICT");
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
