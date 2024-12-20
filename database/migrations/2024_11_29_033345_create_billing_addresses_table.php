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
        Schema::create('billing_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders'); // Reference to the order
            $table->string('name'); // Billing name
            $table->string('email'); // Billing email
            $table->text('address'); // Billing address
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
        Schema::dropIfExists('billing_addresses');
    }
};
