<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableContriPointDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contributor_point_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contributor_id')->unsigned()->nullable();
            $table->integer('lesson_id')->unsigned()->nullable();
            $table->integer('point')->unsigned();
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
        Schema::table('contri_point_details', function (Blueprint $table) {
            //
        });
    }
}
