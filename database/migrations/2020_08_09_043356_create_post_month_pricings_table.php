<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostMonthPricingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_month_pricings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('group_id');
            $table->boolean('is_breakfast_half');
            $table->boolean('is_lunch_full');
            $table->boolean('is_dinner_full');
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
        Schema::dropIfExists('post_month_pricings');
    }
}
