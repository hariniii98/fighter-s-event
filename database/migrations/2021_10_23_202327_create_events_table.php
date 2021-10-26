<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('event_banner_image')->nullable();
            $table->integer('event_category_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->date('reg_deadine')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->integer('age_category_id');
            $table->enum('gender',['M','F']);
            $table->integer('weight_category_id');
            $table->string('location');
            $table->json('allowances_ids');
            $table->json('sponsors_ids');
            $table->text('description')->nullable();
            $table->integer('no_of_rings');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
