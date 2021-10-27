<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefereeEventRingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referee_event_rings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('referee_id')->unsigned();
            $table->foreign('referee_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('event_id')->unsigned();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->integer('ring_id');
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
        Schema::dropIfExists('referee_event_rings');
    }
}
