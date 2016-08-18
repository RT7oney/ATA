<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppTable extends Migration
{
    public function up()
    {
        Schema::create('app', function (Blueprint $table) {
            $table->string('id');
            $table->string('name');
            $table->string('description');
            $table->primary('id');
            $table->unique('name');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::drop('app');
    }

}
