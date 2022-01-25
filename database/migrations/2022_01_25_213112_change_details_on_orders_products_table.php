<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDetailsOnOrdersProductsTable extends Migration
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
            $table->integer('user_id')->after('id')->nullable();
            $table->integer('attribute_id')->after('user_id');
            $table->string('attribute_name')->after('attribute_id')->nullable();
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
            $table->dropColumn('user_id');
            $table->dropColumn('attribute_id');
            $table->dropColumn('attribute_name');
        });
    }
}
