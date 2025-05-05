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
        Schema::create('property_jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('property_id')->nullable()->constrained('properties')->nullOnDelete();
            $table->unsignedBigInteger('engineer')->nullable();
            $table->string('title');
            $table->text('description');
            $table->timestamp('date_time');
            $table->string('error_code')->nullable();
            $table->string('error_code_image')->nullable();
            $table->string('water_pressure_level')->nullable();
            $table->string('tools_info')->nullable();
            $table->text('additional_info')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->enum('status', ['active', 'inactive', 'pending',  'ongoing', 'completed', 'engineer assigned']);
            $table->timestamp('engineer_assigned_at');
            $table->timestamps();
            $table->foreign('engineer')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_jobs');
    }
};
