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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default(1);
            $table->integer('order')->nullable();
            $table->string('name');
            $table->text('detail')->nullable();
            $table->foreignId('country_id')->nullable()->constrained('countries')->onDelete('no action');
            $table->foreignId('state_id')->nullable()->constrained('states')->onDelete('no action');
            $table->foreignId('city_id')->nullable()->constrained('cities')->onDelete('no action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
