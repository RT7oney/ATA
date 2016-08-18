<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessLogTable extends Migration
{
    public function up()
    {
        Schema::create('access_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('method');
            $table->string('uri');
            $table->string('request_params');
            $table->text('request_data');
            $table->integer('status_code');
            $table->string('status_message');
            $table->text('status_data');
            $table->string('ip');
            $table->timestamp('access_begin_at');
            $table->timestamp('access_end_at');
        });
    }


    public function down()
    {
        Schema::drop('access_log');
    }
}
