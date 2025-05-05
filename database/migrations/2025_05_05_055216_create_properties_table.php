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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('address_id')->nullable()->constrained('addresses')->nullOnDelete();
            $table->foreignId('boiler_type_id')->nullable()->constrained('boiler_types')->nullOnDelete();
            $table->foreignId('boiler_model_id')->nullable()->constrained('boiler_models')->nullOnDelete();
            $table->foreignId('property_type_id')->nullable()->constrained('property_types')->nullOnDelete();
            $table->integer('quantity');
            $table->date('purchase_year');
            $table->date('last_service_date')->nullable();
            $table->string('location');
            $table->text('accessability_info');
            $table->decimal('price', 8,2)->nullable();
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
