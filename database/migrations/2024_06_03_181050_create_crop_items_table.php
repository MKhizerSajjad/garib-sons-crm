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
        Schema::create('crop_items', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default(1);
            $table->integer('order')->nullable();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->foreignId('crop_id')->constrained('crops')->onDelete('no action')->indexed();
            $table->foreignId('crop_category_id')->constrained('crop_categories')->onDelete('no action')->indexed();
            // $table->foreignId('crop_type_id')->constrained('crop_types')->onDelete('no action')->indexed();
            $table->foreignId('crop_item_id')->nullable()->constrained('crop_items')->onDelete('no action')->comment('to assign parent item');
            $table->text('detail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
