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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default(1);
            $table->string('code')->unique();

            $table->foreignId('crop_id')->constrained('crops')->onDelete('no action')->indexed();
            $table->foreignId('crop_category_id')->constrained('crop_categories')->onDelete('no action')->indexed();
            $table->foreignId('crop_item_id')->constrained('crop_items')->onDelete('no action')->indexed();
            $table->foreignId('crop_type_id')->constrained('crop_types')->onDelete('no action')->indexed();
            $table->foreignId('crop_year_id')->constrained('crop_years')->onDelete('no action')->indexed();
            $table->foreignId('sub_item_id')->nullable()->constrained('crop_items')->onDelete('no action')->nullable();

            $table->date('dated');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->foreignId('location_id')->constrained('locations')->onDelete('no action');


            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('no action');
            $table->foreignId('supplier_agent_id')->constrained('supplier_agents')->onDelete('no action');


            $table->tinyInteger('min_delivery_mode');
            $table->decimal('min_qty', 10, 2);
            $table->tinyInteger('max_delivery_mode');
            $table->decimal('max_qty', 10, 2);

            $table->tinyInteger('delivery_term');
            $table->decimal('order_rate', 10, 2);
            $table->decimal('kg_rate', 10, 2);
            $table->tinyInteger('brokery_term');
            $table->tinyInteger('replacement');


            $table->decimal('kg_freight', 10, 2);
            $table->decimal('bag_commission', 10, 2);
            $table->decimal('bag_bardana', 10, 2);
            $table->decimal('bag_misc', 10, 2);

            $table->decimal('moisture', 10, 2);
            $table->decimal('broken', 10, 2);
            $table->decimal('damage', 10, 2);
            $table->decimal('chalky', 10, 2);
            $table->decimal('o_v', 10, 2);
            $table->decimal('chobba', 10, 2);
            $table->decimal('look', 10, 2);

            $table->decimal('weight_amount', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->tinyInteger('payment_term');

            $table->text('note')->nullable()->comment('inhouse');
            $table->text('description')->nullable()->comment('for supplier');

            $table->foreignId('created_by')->constrained('users')->onDelete('no action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
