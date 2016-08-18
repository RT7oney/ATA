<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginLogTable extends Migration
{
    public function up()
    {
        Schema::create('login_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('account');
            $table->string('mode');
            $table->integer('status_code');
            $table->string('status_message');
            $table->string('ip');
            $table->string('user_agent');
            $table->timestamp('login_at');
        });
    }


    public function down()
    {
        Schema::drop('login_log');
    }

}
