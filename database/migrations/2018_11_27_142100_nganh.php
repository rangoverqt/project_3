<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Nganh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('nganh',function ($table){
            $table -> increments('id');
            $table -> string('ten_nganh');
            $table -> unsignedInteger('id_khoa');
            $table -> foreign('id_khoa')->references('id')->on('khoa');
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
        Schema::drop('nganh');
    }
}
