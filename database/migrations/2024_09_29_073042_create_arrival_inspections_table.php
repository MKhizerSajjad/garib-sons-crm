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
        Schema::create('arrival_inspections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_order_id')->constrained('purchase_orders')->onDelete('no action')->indexed();
            $table->foreignId('arrival_inspection_id')->nullable()->constrained('arrival_inspections')->onDelete('no action')->indexed()->comment('to assign parent');
            $table->tinyInteger('count')->default(1);
            $table->tinyInteger('status')->default(1)->comment('accept reject');
            $table->date('date')->indexed();
            $table->string('code')->unique();

            $table->integer('bags_no')->indexed();
            $table->integer('pp_bags')->indexed();
            $table->integer('jute_bags')->indexed()->comment('jute bags 100 kg');
            $table->decimal('consignee_weight', 10, 2);
            $table->string('bilty_no')->indexed();
            $table->date('bilty_date')->indexed();

            $table->string('transporter_name');
            $table->tinyInteger('vechile_type')->indexed();
            $table->string('vechile_number');
            $table->string('driver_name');
            $table->string('driver_phone');
            $table->string('driver_nic');

            $table->string('attachement')->nullable();
            $table->text('detail')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('no action')->indexed();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arrival_inspections');
    }
};
