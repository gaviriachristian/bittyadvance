<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailFieldsToAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->decimal('vestedBalance')->nullable();
            $table->decimal('currentLoanBalance')->nullable();
            $table->decimal('interestMarginBalance')->nullable();
            $table->decimal('availableCashBalance')->nullable();
            $table->decimal('availableBalanceAmount')->nullable();
            $table->decimal('loanRate')->nullable();
            $table->decimal('employeeDeferPreTaxAmount')->nullable();
            $table->decimal('employeePreTaxAmount')->nullable();
            $table->decimal('employeePreTaxPercentage')->nullable();
            $table->decimal('employerYearToDate')->nullable();
            $table->decimal('rolloverContributionAmount')->nullable();
            $table->string('allowedCheckWriting')->nullable();
            $table->string('allowedOptionTrade')->nullable();
            $table->decimal('dailyChange')->nullable();
            $table->decimal('margin')->nullable();
            $table->decimal('percentageChange')->nullable();
            $table->decimal('loanPaymentAmount')->nullable();
            $table->timestamp('loanNextPaymentDate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn('vestedBalance');
            $table->dropColumn('currentLoanBalance');
            $table->dropColumn('interestMarginBalance');
            $table->dropColumn('availableCashBalance');
            $table->dropColumn('availableBalanceAmount');
            $table->dropColumn('loanRate');
            $table->dropColumn('employeeDeferPreTaxAmount');
            $table->dropColumn('employeePreTaxAmount');
            $table->dropColumn('employeePreTaxPercentage');
            $table->dropColumn('employerYearToDate');
            $table->dropColumn('rolloverContributionAmount');
            $table->dropColumn('allowedCheckWriting');
            $table->dropColumn('allowedOptionTrade');
            $table->dropColumn('dailyChange');
            $table->dropColumn('margin');
            $table->dropColumn('percentageChange');
            $table->dropColumn('loanPaymentAmount');
            $table->dropColumn('loanNextPaymentDate');
        });
    }
}
