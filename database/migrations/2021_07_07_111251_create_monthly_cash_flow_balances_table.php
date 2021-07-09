<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyCashFlowBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_cash_flow_balances', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('cashFlowBalanceId');
			$table->timestamp('month')->nullable();
			$table->decimal('minDailyBalance')->nullable();
			$table->decimal('maxDailyBalance')->nullable();
			$table->decimal('averageDailyBalance')->nullable();
			$table->decimal('standardDeviationOfDailyBalance')->nullable();
            $table->integer('numberOfDaysNegativeBalance')->nullable();
            $table->integer('numberOfDaysPositiveBalance')->nullable();
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
        Schema::dropIfExists('monthly_cash_flow_balances');
    }
}
