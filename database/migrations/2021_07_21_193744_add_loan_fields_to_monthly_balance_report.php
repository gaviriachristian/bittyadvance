<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLoanFieldsToMonthlyBalanceReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('monthly_balance_report', function (Blueprint $table) {
            $table->decimal('loan_debits_total')->nullable();
            $table->decimal('loan_deposit_total')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('monthly_balance_report', function (Blueprint $table) {
            $table->dropColumn('loan_debits_total');
            $table->dropColumn('loan_deposit_total');
        });
    }
}
