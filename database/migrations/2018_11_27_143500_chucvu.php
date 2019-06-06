<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Chucvu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('chucvu',function ($table){
            $table -> increments('id');
            $table -> string('ten_chucvu');

            $table -> unsignedInteger('id_chucnang_hk');
            $table -> foreign('id_chucnang_hk')->references('id')->on('chucnang_hk')->onDelete('cascade');
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
        Schema::drop('chucvu');
    }
}
