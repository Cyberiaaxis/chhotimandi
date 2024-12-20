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
        Schema::create('shipping_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->string('name'); // Shipping name
            $table->string('email'); // Shipping email
            $table->text('address'); // Shipping address
            $table->string('city'); // City
            $table->string('state')->nullable(); // State
            $table->string('zip_code'); // ZIP code
            $table->string('country'); // Country
            $table->string('phone'); // Contact phone number
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_addresses');
    }
};
