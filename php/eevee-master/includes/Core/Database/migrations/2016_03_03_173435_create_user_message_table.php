<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMessageTable extends Migration
{
    public function up()
    {
        Schema::create('user_message', function (Blueprint $table) {
            $table->string('id');
            $table->string('user_id');
            $table->mediumText('content');
            $table->string('type');
            $table->string('status');
            $table->timestamp('created_at');
            $table->timestamp('expires_at');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::drop('user_message');
    }
}
