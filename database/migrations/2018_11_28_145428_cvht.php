<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cvht extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('cvht',function ($table){
            $table -> increments('id');
            $table -> string('hoten');
            $table -> string('ten_dn');
            $table -> string('password');
            $table -> string('email');
            $table -> integer('sdt');
            $table -> date('ngay_sinh');

            $table -> unsignedInteger('id_chucvu');
            $table -> foreign('id_chucvu')->references('id')->on('chucvu')->onDelete('cascade');

            $table -> unsignedInteger('id_lop');
            $table -> foreign('id_lop')->references('id')->on('lop')->onDelete('cascade');
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
        Schema::drop('cvht');
    }
}
