<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\TypeOfProperty;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'property_name', length: 2000)->unique(true);
            $table->string(column: 'address');
            $table->integer(column: 'bedrooms');
            $table->integer(column: 'bathrooms');
            $table->integer(column: 'floor');
            $table->integer(column: 'parking_spots');
            $table->longText(column: 'description');
            $table->foreignIdFor(TypeOfProperty::class, 'category_id')->references('id')->on('type_of_properties')->onDelete('cascade');
            $table->string(column: 'image_url')->nullable();
            $table->double('area');
            $table->decimal('price', 15, 3);
            $table->boolean(column: 'is_parking_available');
            $table->string('safety');
            $table->string(column: 'payment_process');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
