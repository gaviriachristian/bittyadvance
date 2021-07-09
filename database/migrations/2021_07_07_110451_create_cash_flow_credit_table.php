<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashFlowCreditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_flow_credit', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('accountId');
			$table->decimal('sixMonthCreditTotal')->nullable();
			$table->decimal('sixMonthCreditTotalLessTransfers')->nullable();
            $table->decimal('twoMonthCreditTotal')->nullable();
            $table->decimal('twoMonthCreditTotalLessTransfers')->nullable();
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
        Schema::dropIfExists('cash_flow_credit');
    }
}
