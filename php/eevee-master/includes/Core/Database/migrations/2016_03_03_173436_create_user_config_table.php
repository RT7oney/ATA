<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserConfigTable extends Migration
{
    public function up()
    {
        Schema::create('user_config', function (Blueprint $table) {
            $table->string('id');
            $table->string('user_id');
            $table->string('key');
            $table->mediumText('content');
            $table->primary('id');
            $table->unique(['user_id','key']);
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::drop('user_config');
    }
}
