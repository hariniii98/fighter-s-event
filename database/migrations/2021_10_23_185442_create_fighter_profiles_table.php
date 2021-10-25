<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFighterProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fighter_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('date_of_birth');
            $table->string('emergency_number');
            $table->integer('height');
            $table->float('weight');
            $table->string('club_name');
            $table->string('address');
            $table->string('facebook_id')->nullable();
            $table->string('instagram_id')->nullable();
            $table->string('blood_group');
            $table->string('state');
            $table->unsignedBigInteger('ranking_id')->unsigned()->index()->nullable();
            $table->foreign('ranking_id')->references('id')->on('extra_ranking_points')->onDelete('cascade');
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
        Schema::dropIfExists('fighter_profiles');
    }
}
