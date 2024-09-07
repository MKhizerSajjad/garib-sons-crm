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
        Schema::create('university_courses', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default(2);
            $table->foreignId('university_id')->constrained()->onDelete('cascade')->indexed();
            $table->foreignId('course_id')->constrained()->onDelete('cascade')->indexed();
            $table->text('required_documents')->nullable();
            $table->text('available_shifts')->nullable();
            $table->text('requirements')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('university_courses');
    }
};
