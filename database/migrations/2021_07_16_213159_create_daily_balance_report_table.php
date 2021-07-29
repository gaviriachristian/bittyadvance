<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyBalanceReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_balance_report', function (Blueprint $table) {
            $table->increments('id');
			$table->date('day')->nullable();
			$table->decimal('balance')->nullable();
			$table->decimal('underwriting_balance')->nullable();
            $table->bigInteger('account_id')->nullable();
            $table->bigInteger('customer_id')->nullable();
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
        Schema::dropIfExists('daily_balance_report');
    }
}
