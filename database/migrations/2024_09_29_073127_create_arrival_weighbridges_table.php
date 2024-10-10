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
        Schema::create('arrival_weighbridges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_order_id')->constrained('purchase_orders')->onDelete('no action')->indexed();
            $table->foreignId('arrival_inspection_id')->constrained('arrival_inspections')->onDelete('no action')->indexed();
            $table->foreignId('arrival_gate_pass_id')->constrained('arrival_gate_passes')->onDelete('no action')->indexed()->comment('to assign parent');
            $table->foreignId('arrival_weighbridge_id')->nullable()->constrained('arrival_weighbridges')->onDelete('no action')->indexed();
            $table->tinyInteger('count')->default(1);
            $table->tinyInteger('status')->default(1)->comment('accept reject');
            $table->date('date')->indexed();
            $table->string('code')->unique();

            $table->integer('cosec_no');
            $table->foreignId('weighbridge_id')->constrained('weighbridges')->onDelete('no action')->indexed();
            $table->text('detail')->nullable();

            // Items Detail
            $table->string('no_of_pkg')->nullable()->comment('No of Pkgs');
            $table->decimal('weight', 10, 2)->comment('kg');
            $table->text('goods_detail')->nullable();

            $table->string('attachement')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('no action')->indexed();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arrival_weighbridges');
    }
};
