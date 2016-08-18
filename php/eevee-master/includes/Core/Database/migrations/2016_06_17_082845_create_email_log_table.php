<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailLogTable extends Migration
{
    public function up()
    {
        Schema::create('email_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->text('content');
            $table->integer('status_code');
            $table->string('status_message');
            $table->string('ip');
            $table->timestamp('send_begin_at');
            $table->timestamp('send_end_at');
        });
    }


    public function down()
    {
        Schema::drop('email_log');
    }
}
