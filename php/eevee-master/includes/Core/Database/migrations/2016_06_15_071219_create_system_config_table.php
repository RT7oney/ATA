<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemConfigTable extends Migration
{
    public function up()
    {
        Schema::create('system_config', function (Blueprint $table) {
            $table->string('id');
            $table->string('key');
            $table->mediumText('content');
            $table->primary('id');
            $table->unique(['key']);
        });
    }


    public function down()
    {
        Schema::drop('system_config');
    }
}
