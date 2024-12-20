<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_orders_table.php

    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('order_date')->default(now()); // Order date
            $table->enum('status', ['pending', 'completed', 'canceled', 'under-process'])->default('pending'); // Order status
            $table->decimal('total_amount', 10, 2)->default(0.00); // Original total amount
            $table->string('discount_code')->nullable(); // Applied discount code
            $table->decimal('discount_amount', 10, 2)->default(0.00); // Discount amount applied to the order
            $table->decimal('final_amount', 10, 2)->default(0.00); // Final amount after discounts
            $table->enum('payment_type', ['cod', 'online'])->default('cod'); // Payment type (Cash on Delivery or Online)
            $table->enum('payment_status', ['pending', 'paid', 'refunded', 'failed'])->default('pending'); // Payment status
            $table->enum('delivery_status', ['pending', 'shipped', 'delivered', 'returned', 'canceled'])->default('pending'); // Delivery status
            $table->string('tracking_number')->nullable(); // Tracking number for shipment
            $table->date('delivery_date')->nullable(); // Expected delivery date
            $table->text('notes')->nullable(); // Additional notes
            $table->timestamps(); // Created and Updated timestamps
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
