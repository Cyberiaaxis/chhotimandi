<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('country_code');
            $table->text('message');
            $table->timestamps(); // This will create 'created_at' and 'updated_at' columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact_messages');
    }
}
