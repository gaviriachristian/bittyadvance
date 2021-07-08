<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('customer_id');
            $table->text('event');
            $table->string('type');
            $table->string('action')->nullable();
            $table->string('partner_id')->nullable();
            $table->string('institution_id')->nullable();
            $table->string('product')->nullable();
            $table->string('screen')->nullable();
            $table->string('session_id')->nullable();
            $table->string('search_term')->nullable();
            $table->string('result_count')->nullable();
            $table->string('success')->nullable();
            $table->string('accounts')->nullable();
            $table->string('error_code')->nullable();
            $table->string('alert_type')->nullable();
            $table->string('message')->nullable();
            $table->string('title')->nullable();
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
        Schema::dropIfExists('customers_logs');
    }
}
