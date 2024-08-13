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
        Schema::create('staff_properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->references('id')->on('staff')->onDelete('cascade');
            $table->foreignId('property_id')->references('id')->on('properties')->onDelete('cascade');
    
            $table->unique(['member_id', 'property_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_properties');
    }
};
