<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountOwnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_owner', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('customer_id');
            $table->bigInteger('account_id');
            $table->string('owner_name')->nullable();
            $table->string('owner_address')->nullable();
            $table->timestamp('as_of_date')->nullable();
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
        Schema::dropIfExists('account_owner');
    }
}
