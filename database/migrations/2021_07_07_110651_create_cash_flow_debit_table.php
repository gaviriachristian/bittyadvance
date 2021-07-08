<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_flow_debit', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('accountId');
			$table->decimal('sixMonthDebitTotal')->nullable();
			$table->decimal('sixMonthDebitTotalLessTransfers')->nullable();
			$table->decimal('twoMonthDebitTotal')->nullable();
			$table->decimal('twoMonthDebitTotalLessTransfers')->nullable();
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
        Schema::dropIfExists('cash_flow_debit');
    }
}
