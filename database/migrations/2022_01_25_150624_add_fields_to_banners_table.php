<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banners', function (Blueprint $table) {
            //
            $table->string('topic1')->nullable();
            $table->string('topic2')->nullable();
            $table->string('topic3')->nullable();
            $table->string('body1')->nullable();
            $table->string('body2')->nullable();
            $table->string('body3')->nullable();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banners', function (Blueprint $table) {
            //
            $table->dropColumn('topic1');
            $table->dropColumn('topic2');
            $table->dropColumn('topic3');
            $table->dropColumn('body1');
            $table->dropColumn('body2');
            $table->dropColumn('body3');
        });
    }
}
