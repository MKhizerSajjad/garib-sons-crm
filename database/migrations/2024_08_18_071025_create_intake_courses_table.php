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
        Schema::create('intake_courses', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default(2);
            $table->foreignId('intake_id')->constrained()->onDelete('cascade')->indexed();
            $table->foreignId('course_id')->constrained()->onDelete('cascade')->indexed();
            $table->date('start_date');
            $table->date('end_date');
            $table->text('required_documents')->nullable();
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
        Schema::dropIfExists('intake_courses');
    }
};
