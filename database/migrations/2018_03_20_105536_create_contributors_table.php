<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContributorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contributors', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('status')->default(0);
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->boolean('packages_status')->default(0);
            $table->integer('packages_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->boolean('active')->default(false);
            $table->string('activation_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contributors');
    }
}
