<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyCashFlowCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_cash_flow_credits', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('cashFlowCreditId');
			$table->timestamp('month')->nullable();
            $table->integer('numberOfCredits')->nullable();
			$table->decimal('totalCreditsAmount')->nullable();
			$table->decimal('largestCredit')->nullable();
            $table->integer('numberOfCreditsLessTransfers')->nullable();
			$table->decimal('totalCreditsAmountLessTransfers')->nullable();
			$table->decimal('averageCreditAmount')->nullable();
            $table->integer('estimatedNumberOfLoanDeposits')->nullable();
            $table->integer('estimatedLoanDepositAmount')->nullable();
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
        Schema::dropIfExists('monthly_cash_flow_credits');
    }
}
