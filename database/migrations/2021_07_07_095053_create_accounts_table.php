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
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigInteger('id')->unique();
            $table->bigInteger('number');
            $table->integer('accountNumberDisplay')->nullable();
            $table->string('name')->nullable();
            $table->string('ownerName')->nullable();
            $table->string('ownerAddress')->nullable();
            $table->decimal('balance')->nullable();
            $table->decimal('currentBalance')->nullable();
            $table->string('type')->nullable();
            $table->integer('aggregationStatusCode')->nullable();
            $table->string('status')->nullable();
            $table->bigInteger('customerId')->nullable();
            $table->integer('institutionId')->nullable();
            $table->timestamp('balanceDate')->nullable();
            $table->timestamp('aggregationSuccessDate')->nullable();
            $table->timestamp('aggregationAttemptDate')->nullable();
            $table->timestamp('createdDate')->nullable();
            $table->timestamp('lastUpdatedDate')->nullable();
            $table->string('currency')->nullable();
            $table->timestamp('lastTransactionDate')->nullable();
            $table->bigInteger('institutionLoginId')->nullable();
            $table->integer('displayPosition')->nullable();
            $table->string('financialinstitutionAccountStatus')->nullable();
            $table->string('accountNickname')->nullable();
            $table->timestamp('oldestTransactionDate')->nullable();
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
        Schema::dropIfExists('accounts');
    }
}
