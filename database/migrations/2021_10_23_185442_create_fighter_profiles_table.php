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
            $table->integer('user_id');
            $table->date('date_of_birth');
            $table->string('emergency_number');
            $table->integer('height');
            $table->float('weight');
            $table->string('club_name');
            $table->string('address');
            $table->string('facebook_id');
            $table->string('instagram_id');
            $table->string('blood_group');
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
