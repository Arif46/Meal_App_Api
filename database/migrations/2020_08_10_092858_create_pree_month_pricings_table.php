<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreeMonthPricingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pree_month_pricings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('group_id');
            $table->float('breakfast');
            $table->float('lunch');
            $table->float('dinner');
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
        Schema::dropIfExists('pree_month_pricings');
    }
}
