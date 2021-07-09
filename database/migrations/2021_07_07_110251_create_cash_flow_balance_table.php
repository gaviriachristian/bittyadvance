<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashFlowBalanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_flow_balance', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('accountId');
			$table->decimal('minDailyBalance')->nullable();
			$table->decimal('maxDailyBalance')->nullable();
			$table->decimal('sixMonthAverageDailyBalance')->nullable();
			$table->decimal('twoMonthAverageDailyBalance')->nullable();
			$table->decimal('sixMonthStandardDeviationOfDailyBalance')->nullable();
			$table->decimal('twoMonthStandardDeviationOfDailyBalance')->nullable();
            $table->integer('numberOfDaysNegativeBalance')->nullable();
            $table->integer('numberOfDaysPositiveBalance')->nullable();
            $table->boolean('summary')->nullable();
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
        Schema::dropIfExists('cash_flow_balance');
    }
}
