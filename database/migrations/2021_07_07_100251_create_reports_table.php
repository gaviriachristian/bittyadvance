<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('reportId');
			$table->string('id')->unique();
			$table->bigInteger('customerId');
            $table->boolean('gseEnabled')->nullable();
            $table->string('customerType')->nullable();
			$table->string('requestId')->nullable();
            $table->string('title')->nullable();
			$table->string('consumerId')->nullable();
			$table->string('consumerSsn')->nullable();
			$table->string('requesterName')->nullable();
			$table->string('type')->nullable();
			$table->string('status')->nullable();
            $table->integer('days')->nullable();
            $table->boolean('seasoned')->nullable();
            $table->timestamp('createdDate')->nullable();
            $table->timestamp('startDate')->nullable();
            $table->timestamp('endDate')->nullable();
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
        Schema::dropIfExists('reports');
    }
}
