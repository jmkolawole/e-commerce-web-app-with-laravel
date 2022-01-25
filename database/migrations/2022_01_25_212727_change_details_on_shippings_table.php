<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDetailsOnShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('shipping_addresses', function (Blueprint $table) {
            //
            $table->integer('user_id')->after('id')->nullable();
            $table->integer('order_id')->after('user_id');
            $table->string('session_id')->after('order_id')->nullable();
            $table->string('postcode')->after('country')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('shipping_addresses', function (Blueprint $table) {
            //
            $table->dropColumn('user_id');
            $table->dropColumn('order_id');
            $table->dropColumn('session_id');
            $table->dropColumn('postcode');
        });
    }
}
