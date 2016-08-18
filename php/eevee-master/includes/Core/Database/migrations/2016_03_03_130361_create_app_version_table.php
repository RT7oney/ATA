<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppVersionTable extends Migration
{
    public function up()
    {
        Schema::create('app_version', function (Blueprint $table) {
            $table->string('app_id');
            $table->string('version');
            $table->string('description');
            $table->string('status');
            $table->timestamps();
            $table->primary(['app_id', 'version']);
            $table->foreign('app_id')->references('id')->on('app')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::drop('app_version');
    }

}
