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
            $table->integer('detail_income_id')->unsigned();
            $table->integer('bank_transfer')->unsigned();
            $table->dateTime('transfer_date');
            $table->decimal('total_transfer', 10, 2);
            $table->string('note');
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
