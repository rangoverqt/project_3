<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hoatdong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('hoatdong',function ($table){
            $table -> increments('id');
            $table -> string('ten_hoatdong');
            $table -> integer('diem');
            $table -> date('ngay_bd');
            $table -> date('ngay_kt');
            $table -> integer('thoi_luong');
            $table -> integer('soluong');
            $table -> integer('thanh_tich');

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
        Schema::drop('hoatdong');
    }
}
