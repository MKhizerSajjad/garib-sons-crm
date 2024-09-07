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
        Schema::create('universities', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default(1);
            $table->string('name')->indexed();
            $table->string('short_name')->indexed();
            $table->string('established_year')->nullable();
            $table->foreignId('university_id')->constrained()->onDelete('cascade')->indexed()->nullable()->comment('to assign main campus');
            $table->string('lattitude')->nullable();
            $table->string('longitude')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('city_id')->constrained()->onDelete('cascade');
            $table->foreignId('state_id')->constrained()->onDelete('cascade');
            $table->foreignId('country_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('universities');
    }
};
