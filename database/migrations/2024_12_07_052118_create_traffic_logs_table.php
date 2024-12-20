<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('traffic_logs', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->string('url');
            $table->string('method');
            $table->string('user_agent');
            $table->string('country')->nullable(); // Added country column
            $table->string('region')->nullable(); // Added region column
            $table->string('city')->nullable(); // Added city column
            $table->decimal('latitude', 10, 7)->nullable(); // Added latitude column
            $table->decimal('longitude', 10, 7)->nullable(); // Added longitude column
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traffic_logs');
    }
};
