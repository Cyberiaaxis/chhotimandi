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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Unique discount code
            $table->enum('type', ['percentage', 'flat'])->default('percentage'); // Type of discount
            $table->decimal('value', 8, 2); // Discount value (e.g., 10% or $10)
            $table->date('start_date')->nullable(); // Start date for validity
            $table->date('end_date')->nullable(); // End date for validity
            $table->integer('min_amount')->default(0);
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products'); // Optional product-specific discount // Optional product-specific discount
            $table->boolean('is_active')->default(true); // Active status
            $table->timestamps(); // Created and Updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts_tabl');
    }
};
