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
         Schema::table('orders', function (Blueprint $table) {
            $table->string('vessel_name')->nullable();
            $table->string('imo_number')->nullable(); // International Maritime Organization number
            $table->string('voyage_number')->nullable();
            $table->string('bill_of_lading')->nullable();
        });

        // Create a dedicated table for maritime containers
        Schema::create('maritime_containers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('container_number')->unique(); // e.g. MSKU1234567
            $table->string('type'); // e.g. 20GP, 40HC
            $table->string('seal_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
