<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // ---------------------------
    //  id | role     | slug     |
    // ---------------------------
    //  1  | Admin    | admin    |
    // ---------------------------
    //  2  | Owner    | owner    |
    // ---------------------------
    //  3  | Landlord | landlord |
    // ---------------------------
    //  4  | Engineer | engineer |
    // ---------------------------
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
