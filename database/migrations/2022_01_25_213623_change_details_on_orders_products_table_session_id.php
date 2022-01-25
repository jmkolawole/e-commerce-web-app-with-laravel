<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDetailsOnOrdersProductsTableSessionId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('orders_products', function (Blueprint $table) {
            //
            $table->string('session_id')->after('user_id')->nullable()->change();
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
        Schema::table('orders_products', function (Blueprint $table) {
            //
            $table->string('session_id')->after('user_id')->change();
        });
    }
}
