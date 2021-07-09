<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashFlowCharacteristicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_flow_characteristic', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('accountId');
			$table->decimal('averageMonthlyNet')->nullable();
			$table->decimal('averageMonthlyNetLessTransfers')->nullable();
			$table->decimal('sixMonthAverageTotalCreditsLessTotalDebits')->nullable();
			$table->decimal('sixMonthAverageTotalCreditsLessTotalDebitsLessTransfers')->nullable();
			$table->decimal('twoMonthAverageTotalCreditsLessTotalDebits')->nullable();
			$table->decimal('twoMonthAverageTotalCreditsLessTotalDebitsLessTransfers')->nullable();
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
        Schema::dropIfExists('cash_flow_characteristic');
    }
}
