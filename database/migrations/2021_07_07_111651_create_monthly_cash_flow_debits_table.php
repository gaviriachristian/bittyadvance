<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyCashFlowDebitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_cash_flow_debits', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('cashFlowDebitId');
			$table->timestamp('month')->nullable();
            $table->integer('numberOfDebits')->nullable();
			$table->decimal('totalDebitsAmount')->nullable();
			$table->decimal('largestDebit')->nullable();
            $table->integer('numberOfDebitsLessTransfers')->nullable();
			$table->decimal('totalDebitsAmountLessTransfers')->nullable();
			$table->decimal('averageDebitAmount')->nullable();
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
        Schema::dropIfExists('monthly_cash_flow_debits');
    }
}
