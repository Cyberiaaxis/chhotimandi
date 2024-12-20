<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name'); // Product name
            $table->text('description'); // Product description
            $table->decimal('price', 8, 2); // Price field with two decimal places
            $table->string('image')->nullable(); // Nullable image field
            $table->boolean('is_active')->default(0); // Default value of 0 (inactive)
            $table->integer('qty')->default(1);
            // Add category_id column and foreign key constraint
            $table->unsignedBigInteger('category_id')->nullable(); // Foreign key column
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null'); // Foreign key constraint

            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('products'); // Drop the products table if rolling back
    }
}
