<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailFields2ToAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->decimal('payoffAmount')->nullable();
            $table->decimal('principalBalance')->nullable();
            $table->decimal('escrowBalance')->nullable();
            $table->string('interestRate')->nullable();
            $table->string('autoPayEnrolled')->nullable();
            $table->string('collateral')->nullable();
            $table->string('currentSchool')->nullable();
            $table->string('firstMortgage')->nullable();
            $table->string('originalSchool')->nullable();
            $table->decimal('recurringPaymentAmount')->nullable();
            $table->string('lender')->nullable();
            $table->decimal('endingBalanceAmount')->nullable();
            $table->string('loanTermType')->nullable();
            $table->decimal('paymentsMade')->nullable();
            $table->decimal('balloonAmount')->nullable();
            $table->decimal('projectedInterest')->nullable();
            $table->decimal('interestPaidLtd')->nullable();
            $table->string('interestRateType')->nullable();
            $table->string('loanPaymentType')->nullable();
            $table->decimal('paymentsRemaining')->nullable();
            $table->decimal('loanMinAmtDue')->nullable();
            $table->string('loanPaymentFreq')->nullable();
            $table->decimal('paymentMinAmount')->nullable();
            $table->timestamp('loanMinAmtDueDate')->nullable();
            $table->timestamp('firstPaymentDate')->nullable();
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
            $table->dropColumn('payoffAmount');
            $table->dropColumn('principalBalance');
            $table->dropColumn('escrowBalance');
            $table->dropColumn('interestRate');
            $table->dropColumn('autoPayEnrolled');
            $table->dropColumn('collateral');
            $table->dropColumn('currentSchool');
            $table->dropColumn('firstMortgage');
            $table->dropColumn('originalSchool');
            $table->dropColumn('recurringPaymentAmount');
            $table->dropColumn('lender');
            $table->dropColumn('endingBalanceAmount');
            $table->dropColumn('loanTermType');
            $table->dropColumn('paymentsMade');
            $table->dropColumn('balloonAmount');
            $table->dropColumn('projectedInterest');
            $table->dropColumn('interestPaidLtd');
            $table->dropColumn('interestRateType');
            $table->dropColumn('loanPaymentType');
            $table->dropColumn('paymentsRemaining');
            $table->dropColumn('loanMinAmtDue');
            $table->dropColumn('loanPaymentFreq');
            $table->dropColumn('paymentMinAmount');
            $table->dropColumn('loanMinAmtDueDate');
            $table->dropColumn('firstPaymentDate');
        });
    }
}
