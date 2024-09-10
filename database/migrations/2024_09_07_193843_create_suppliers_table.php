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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default(1);
            $table->string('name')->unique();
            $table->string('email')->nullable();
            $table->string('landline')->nullable();
            $table->string('phone')->unique();
            $table->text('detail')->nullable();
            $table->foreignId('country_id')->constrained('countries')->onDelete('no action');
            $table->foreignId('state_id')->constrained('states')->onDelete('no action');
            $table->foreignId('city_id')->constrained('cities')->onDelete('no action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
