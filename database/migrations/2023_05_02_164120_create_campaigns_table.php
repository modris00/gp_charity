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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('title' , 100);
            $table->float('amount');
            $table->enum('status' , ["Finished" , "Not Finished"]);
            $table->string('start_date');
            $table->string('end_date');

            $table->foreignId("admin_id")->constrained(); // FK
            $table->foreignId("currency_id")->constrained(); // FK

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
