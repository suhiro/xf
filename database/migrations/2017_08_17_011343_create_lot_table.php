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
        Schema::create('event_logs', function (Blueprint $table) {
            $table->dateTime('MCGS_Time');
            $table->integer('MCGS_TIMEMS');
            $table->string('serial',16);
            $table->string('user_id',16);
            $table->string('ERR_event',32);
            $table->string('TestSite_ON',16);
            $table->integer('output');
            $table->primary(['MCGS_Time','MCGS_TIMEMS','serial','ERR_event']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_logs');
    }
}
