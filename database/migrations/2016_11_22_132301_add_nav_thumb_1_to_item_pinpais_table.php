<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNavThumb1ToItemPinpaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_pinpais', function (Blueprint $table) {
            $table->string('nav_thumb_1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_pinpais', function (Blueprint $table) {
            $table->dropColumn('nav_thumb_1');
        });
    }
}
