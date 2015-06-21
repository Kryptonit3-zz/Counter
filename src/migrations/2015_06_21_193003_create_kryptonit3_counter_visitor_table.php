<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKryptonit3CounterVisitorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kryptonit3_counter_visitor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('visitor')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kryptonit3_counter_visitor');
    }
}
