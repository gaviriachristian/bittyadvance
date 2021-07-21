<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyBalanceReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_balance_report', function (Blueprint $table) {
            $table->increments('id');
			$table->date('month')->nullable();
			$table->integer('days_negative')->nullable();
			$table->decimal('average')->nullable();
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
        Schema::dropIfExists('monthly_balance_report');
    }
}
