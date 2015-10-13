<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('citizen_id')->unsigned()->length(10);
            $table->integer('lawyer_id')->unsigned()->length(10);
            $table->dateTime('appointment_datetime');
            $table->enum('status', array('pending', 'approved','rejected'));
            $table->timestamps();

            $table->foreign('citizen_id')
                ->references('id')->on('citizens')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('lawyer_id')
                ->references('id')->on('lawyers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('appointments');
    }
}
