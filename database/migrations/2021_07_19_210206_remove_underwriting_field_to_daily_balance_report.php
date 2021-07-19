<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUnderwritingFieldToDailyBalanceReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_balance_report', function (Blueprint $table) {
            $table->dropColumn('underwriting_balance');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daily_balance_report', function (Blueprint $table) {
			$table->decimal('underwriting_balance')->nullable();
        });
    }
}
