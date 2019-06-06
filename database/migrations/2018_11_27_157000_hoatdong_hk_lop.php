<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HoatdongHkLop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('hoatdong_hk_lop',function ($table){
            $table -> increments('id');

            $table -> unsignedInteger('id_hoatdong');

            $table ->foreign('id_hoatdong')->references('id')->on('hoatdong')->onDelete('cascade');

            $table -> unsignedInteger('id_hocky');

            $table ->foreign('id_hocky')->references('id')->on('hocky')->onDelete('cascade');

            $table -> unsignedInteger('id_lop');

            $table ->foreign('id_lop')->references('id')->on('lop')->onDelete('cascade');
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
        Schema::drop('hoatdong_hk_lop');
    }
}
