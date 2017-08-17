<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lot_events', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps('MCGS_Time');
            $table->integer('MCGS_TIMEMS');
            $table->string('serial');
            $table->string('user_id');
            $table->string('ERR_event');
            $table->string('TestSite_ON');
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
        Schema::dropIfExists('lot_events');
    }
}
