<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->float('total_amount')->after('grand_total');
            $table->string('coupon_code')->after('total_amount')->nullable();
            $table->float('coupon_amount')->after('coupon_code')->nullable();
            $table->integer('coupon_rate')->after('coupon_amount')->nullable();
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
             $table->dropColumn('total_amount');
             $table->dropColumn('coupon_code');
             $table->dropColumn('coupon_amount');
             $table->dropColumn('coupon_rate');
        });
    }
}
