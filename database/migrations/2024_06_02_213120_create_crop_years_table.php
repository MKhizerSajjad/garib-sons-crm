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
        Schema::create('crop_years', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default(1);
            $table->integer('order')->nullable();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->text('detail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crop_years');
    }
};