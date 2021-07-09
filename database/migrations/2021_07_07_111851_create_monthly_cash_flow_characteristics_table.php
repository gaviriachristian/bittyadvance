<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyCashFlowCharacteristicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_cash_flow_characteristics', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('cashFlowCharacteristicId');
			$table->timestamp('month')->nullable();
			$table->decimal('totalCreditsLessTotalDebits')->nullable();
			$table->decimal('totalCreditsLessTotalDebitsLessTransfers')->nullable();
			$table->decimal('averageTransactionAmount')->nullable();
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
        Schema::dropIfExists('monthly_cash_flow_characteristics');
    }
}
