<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemPinpaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_pinpais', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->string('thumb')->default('/images/default.png');
            $table->string('nav_top');
            $table->string('nav_thumb')->default('/images/default.png');
            $table->string('nav_thumb_1')->default('/images/default.png');
            $table->string('nav_bottom');
            $table->string('extra_thumb')->default('/images/default.png');
            $table->string('extra_description');
            $table->string('extra_list');
            $table->integer('website_id');
            $table->foreign('website_id')->references('id')->on('websites');
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
        Schema::dropIfExists('item_pinpais');
    }
}
