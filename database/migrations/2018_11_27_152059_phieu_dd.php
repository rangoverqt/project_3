<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PhieuDd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('phieu_dd',function ($table){
            $table -> increments('id');
            $table -> integer('thamgia');

            $table -> unsignedInteger('id_hocvien');
            $table -> foreign('id_hocvien')->references('id')->on('hocvien')->onDelete('cascade');

            $table -> unsignedInteger('id_hoatdong');
            $table -> foreign('id_hoatdong')->references('id')->on('hoatdong')->onDelete('cascade');
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
        Schema::drop('phieu_dd');
    }
}
