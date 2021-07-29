<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyDepositsReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_deposits_report', function (Blueprint $table) {
            $table->increments('id');
			$table->date('year_month')->nullable();
			$table->decimal('amount')->nullable();
			$table->decimal('underwriting_total')->nullable();
            $table->integer('positive_transaction_count')->nullable();
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
        Schema::dropIfExists('monthly_deposits_report');
    }
}
