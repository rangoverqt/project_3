<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Lop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('lop',function ($table){
            $table -> increments('id');
            $table -> string('ten_lop');
            $table -> integer('soluong');

            $table -> unsignedInteger('id_nganh');
            $table -> foreign('id_nganh')->references('id')->on('nganh')->onDelete('cascade');
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
        Schema::drop('lop');
    }
}
