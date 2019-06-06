<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChucnangHk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('chucnang_hk',function ($table){
            $table -> increments('id');

            $table -> unsignedInteger('id_hocky');
            $table -> foreign('id_hocky')->references('id')->on('hocky')->onDelete('cascade');

            $table -> unsignedInteger('id_chucnang');
            $table -> foreign('id_chucnang')->references('id')->on('chucnang')->onDelete('cascade');
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
        Schema::drop('chucnang_hk');
    }
}
