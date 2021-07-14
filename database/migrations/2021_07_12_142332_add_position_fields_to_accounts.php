<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPositionFieldsToAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->bigInteger('positionId')->nullable();
            $table->text('description')->nullable();
            $table->string('cusipNo')->nullable();
            $table->string('symbol')->nullable();
            $table->decimal('quantity')->nullable();
            $table->decimal('currentPrice')->nullable();
            $table->string('marketValue')->nullable();
            $table->decimal('changePercent')->nullable();
            $table->decimal('costBasis')->nullable();
            $table->integer('dailyChangePosition')->nullable();
            $table->string('memo')->nullable();
            $table->string('fundName')->nullable();
            $table->string('securityName')->nullable();
            $table->string('transactionType')->nullable();
            $table->integer('empPretaxContribAmount')->nullable();
            $table->string('heldInAccount')->nullable();
            $table->string('holdType')->nullable();
            $table->decimal('maturityValue')->nullable();
            $table->decimal('units')->nullable();
            $table->decimal('unitPrice')->nullable();
            $table->string('typePosition')->nullable();
            $table->string('statusPosition')->nullable();
            $table->string('invSecurityType')->nullable();
            $table->string('securityCurrencyRate')->nullable();
            $table->decimal('averageCost')->nullable();
            $table->decimal('cashAccount')->nullable();
            $table->decimal('faceValue')->nullable();
            $table->string('holdingId')->nullable();
            $table->string('securitySubType')->nullable();
            $table->decimal('rate')->nullable();
            $table->string('unitType')->nullable();
            $table->decimal('todayGLDollar')->nullable();
            $table->decimal('todayGLPercent')->nullable();
            $table->decimal('totalGLDollar')->nullable();
            $table->decimal('totalGLPercent')->nullable();
            $table->decimal('costBasisPerShare')->nullable();
            $table->string('enterpriseSymbol')->nullable();
            $table->decimal('localMarketValue')->nullable();
            $table->decimal('localPrice')->nullable();
            $table->string('securityId')->nullable();
            $table->string('reinvestmentCapGains')->nullable();
            $table->string('reinvestmentDividend')->nullable();
            $table->timestamp('currentPriceDate')->nullable();
            $table->timestamp('expirationDate')->nullable();
            $table->timestamp('originalPurchaseDate')->nullable();
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
            $table->dropColumn('positionId');
            $table->dropColumn('description');
            $table->dropColumn('cusipNo');
            $table->dropColumn('symbol');
            $table->dropColumn('quantity');
            $table->dropColumn('currentPrice');
            $table->dropColumn('marketValue');
            $table->dropColumn('changePercent');
            $table->dropColumn('costBasis');
            $table->dropColumn('dailyChangePosition');
            $table->dropColumn('memo');
            $table->dropColumn('fundName');
            $table->dropColumn('securityName');
            $table->dropColumn('transactionType');
            $table->dropColumn('empPretaxContribAmount');
            $table->dropColumn('heldInAccount');
            $table->dropColumn('holdType');
            $table->dropColumn('maturityValue');
            $table->dropColumn('units');
            $table->dropColumn('unitPrice');
            $table->dropColumn('typePosition');
            $table->dropColumn('statusPosition');
            $table->dropColumn('invSecurityType');
            $table->dropColumn('securityCurrencyRate');
            $table->dropColumn('averageCost');
            $table->dropColumn('cashAccount');
            $table->dropColumn('faceValue');
            $table->dropColumn('holdingId');
            $table->dropColumn('securitySubType');
            $table->dropColumn('rate');
            $table->dropColumn('unitType');
            $table->dropColumn('todayGLDollar');
            $table->dropColumn('todayGLPercent');
            $table->dropColumn('totalGLDollar');
            $table->dropColumn('totalGLPercent');
            $table->dropColumn('costBasisPerShare');
            $table->dropColumn('enterpriseSymbol');
            $table->dropColumn('localMarketValue');
            $table->dropColumn('localPrice');
            $table->dropColumn('securityId');
            $table->dropColumn('reinvestmentCapGains');
            $table->dropColumn('reinvestmentDividend');
            $table->dropColumn('currentPriceDate');
            $table->dropColumn('expirationDate');
            $table->dropColumn('originalPurchaseDate');
        });
    }
}
