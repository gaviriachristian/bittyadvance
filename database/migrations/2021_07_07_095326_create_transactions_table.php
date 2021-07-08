<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigInteger('id')->unique();
            $table->decimal('amount')->nullable();
            $table->bigInteger('accountId');
            $table->bigInteger('customerId');
            $table->string('status',10)->nullable();
            $table->text('description')->nullable();
            $table->string('memo')->nullable();
            $table->decimal('feeAmount')->nullable();
            $table->string('symbol',50)->nullable();
            $table->bigInteger('unitQuantity')->nullable();
            $table->string('unitAction',50)->nullable();
            $table->timestamp('postedDate')->nullable();
            $table->timestamp('transactionDate')->nullable();
            $table->timestamp('createdDate')->nullable();
            $table->string('confirmationNumber')->nullable();
            $table->string('payeeId')->nullable();
            $table->string('extendedPayeeName')->nullable();
            $table->string('originalCurrency',10)->nullable();
            $table->bigInteger('runningBalanceAmount')->nullable();
            $table->bigInteger('escrowTaxAmount')->nullable();
            $table->bigInteger('escrowInsuranceAmount')->nullable();
            $table->bigInteger('escrowPmiAmount')->nullable();
            $table->bigInteger('escrowFeesAmount')->nullable();
            $table->bigInteger('escrowOtherAmount')->nullable();
            $table->string('inv401kSource')->nullable();
            $table->string('relatedInstitutionTradeId')->nullable();
            $table->string('subaccountSecurityType')->nullable();
            $table->string('normalizedPayee')->nullable();
            $table->bigInteger('penaltyAmount')->nullable();
            $table->bigInteger('sharesPerContract')->nullable();
            $table->bigInteger('stateWithholding')->nullable();
            $table->bigInteger('taxesAmount')->nullable();
            $table->bigInteger('unitPrice')->nullable();
            $table->string('securedType')->nullable();
            $table->string('reveralInstitutionTransactionId')->nullable();
            $table->string('institutionTransactionId')->nullable();
            $table->string('investmentTransactionType')->nullable();
            $table->string('category')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
