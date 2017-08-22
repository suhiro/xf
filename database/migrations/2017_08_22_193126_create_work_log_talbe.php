<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkLogTalbe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serial');
            $table->string('customer');
            $table->string('customerId');
            $table->string('setCode');
            $table->datetime('timeStart');
            $table->datetime('timeEnd');
            $table->integer('workMinutes');
            $table->integer('output');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_log');
    }
}
