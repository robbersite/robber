<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsiteOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('start');
            $table->integer('stop');
            $table->string('last');
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
        Schema::dropIfExists('website_orders');
    }
}
