<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('invoice', function (Blueprint $table) {
          $table->increments('id');
          $table->boolean('status')->default(0);
          $table->string('code');
          $table->integer('members_id');
          $table->integer('packages_id');
          $table->string('price');
          $table->string('type')->nullable();
          $table->string('description')->nullable();
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
        Schema::dropIfExist('invoice');
    }
}
