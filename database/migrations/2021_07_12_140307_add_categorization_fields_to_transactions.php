<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategorizationFieldsToTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('normalizedPayeeName')->nullable();
            $table->string('categoryCategorization')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postalCode')->nullable();
            $table->string('country')->nullable();
            $table->string('bestRepresentation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('normalizedPayeeName');
            $table->dropColumn('categoryCategorization');
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('postalCode');
            $table->dropColumn('country');
            $table->dropColumn('bestRepresentation');
        });
    }
}
