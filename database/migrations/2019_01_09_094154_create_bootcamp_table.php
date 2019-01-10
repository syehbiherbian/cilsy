<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBootcampTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bootcamp', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bootcamp_category_id');
            $table->integer('bootcamp_sub_category_id');
            $table->string('title', 50);
            $table->string('sub_title', 50);
            $table->string('cover');
            $table->decimal('price', 10, 0);
            $table->string('promote_video')->nullable();
            $table->text('deskripsi');
            $table->string('audience');
            $table->text('pre_and_req');
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
        Schema::dropIfExists('bootcamp');
    }
}
