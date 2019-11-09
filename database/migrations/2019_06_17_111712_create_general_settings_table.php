<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('store_name');
            $table->string('activity');
            $table->integer('phone');
            $table->string('address');
            $table->date('start_day');
            $table->string('image');
            $table->double('investment_capital');
            $table->string('rc');
            $table->integer('article');
            $table->integer('nif');
            $table->integer('nis');
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
        Schema::dropIfExists('general_settings');
    }
}