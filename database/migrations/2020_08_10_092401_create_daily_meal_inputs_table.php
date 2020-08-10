<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyMealInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_meal_inputs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('group_id');
            $table->dateTime('breakfast_date_time');
            $table->dateTime('lunch_date_time');
            $table->dateTime('dinner_date_time');
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
        Schema::dropIfExists('daily_meal_inputs');
    }
}
