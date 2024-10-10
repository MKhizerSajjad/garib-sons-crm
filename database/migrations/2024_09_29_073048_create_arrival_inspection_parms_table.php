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
        Schema::create('arrival_inspection_parms', function (Blueprint $table) {
            $table->foreignId('arrival_inspection_id')->constrained('arrival_inspections')->onDelete('no action')->indexed();
            $table->integer('type')->indexed();
            $table->integer('value')->indexed();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arrival_inspection_parms');
    }
};
