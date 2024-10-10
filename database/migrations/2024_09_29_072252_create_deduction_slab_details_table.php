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
        Schema::create('deduction_slab_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deduction_slab_id')->constrained('deduction_slabs')->onDelete('no action')->indexed();
            $table->decimal('from', 10, 2);
            $table->decimal('to', 10, 2);
            $table->decimal('deduction', 10, 2);
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deduction_slab_details');
    }
};
