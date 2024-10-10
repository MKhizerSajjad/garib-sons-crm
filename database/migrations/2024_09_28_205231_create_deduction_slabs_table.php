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
        Schema::create('deduction_slabs', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('type')->indexed();
            $table->foreignId('crop_id')->constrained('crops')->onDelete('no action')->indexed();
            $table->foreignId('crop_category_id')->constrained('crop_categories')->onDelete('no action')->indexed();
            $table->foreignId('crop_item_id')->constrained('crop_items')->onDelete('no action')->indexed();
            $table->foreignId('crop_type_id')->constrained('crop_types')->onDelete('no action')->indexed();
            $table->foreignId('crop_year_id')->constrained('crop_years')->onDelete('no action')->indexed();
            $table->text('detail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deduction_slabs');
    }
};
