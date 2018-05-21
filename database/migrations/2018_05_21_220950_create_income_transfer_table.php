<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomeTransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_transfer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('detail_income_id');
            $table->integer('bank_transfer');
            $table->dateTime('transfer_date');
            $table->string('total_transfer');
            $table->text('note');
            $table->string('file');
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
        Schema::dropIfExists('income_transfer');
    }
}
