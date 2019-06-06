<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LopNh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('lop_nh',function ($table){
            $table -> increments('id');

            $table -> unsignedInteger('id_nh');

            $table ->foreign('id_nh')->references('id')->on('namhoc')->onDelete('cascade');

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
        Schema::drop('lop_nh');
    }
}
