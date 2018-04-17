<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('packages_detail', function (Blueprint $table) {
          $table->increments('id');
          $table->string('price');
          $table->integer('expired');
          $table->string('access');
          $table->string('update');
          $table->integer('chat');
          $table->string('download');
          $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExist('packages_detail');
    }
}
