<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemMessageTable extends Migration
{
    public function up()
    {
        Schema::create('system_message', function (Blueprint $table) {
            $table->string('id');
            $table->mediumText('content');
            $table->string('type');
            $table->string('status');
            $table->timestamp('created_at');
            $table->timestamp('expires_at');
        });
    }


    public function down()
    {
        Schema::drop('system_message');
    }
}
