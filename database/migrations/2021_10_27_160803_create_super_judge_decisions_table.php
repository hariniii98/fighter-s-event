<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuperJudgeDecisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('super_judge_decisions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('super_judge_id')->unsigned();
            $table->bigInteger('event_id')->unsigned();
            $table->integer('stage_id');
            $table->integer('match_id');
            $table->bigInteger('winner_id')->unsigned()->nullable();
            $table->bigInteger('looser_id')->unsigned()->nullable();
            $table->text('winner_ids')->nullable();
            $table->text('remarks')->nullable();
            $table->enum('decision_type',['tko','ko','sd','ud','sub','draw','others']);
            $table->foreign('super_judge_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('winner_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('looser_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('super_judge_decisions');
    }
}
