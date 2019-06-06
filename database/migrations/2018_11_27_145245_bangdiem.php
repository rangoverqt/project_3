<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Bangdiem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('bangdiem',function ($table){
            $table -> increments('id');
            $table -> integer('diemtong');
            $table -> integer('lan_1')->nullable($value = true);
            $table -> integer('lan_2')->nullable($value = true);
            $table -> string('xeploai');

            $table -> unsignedInteger('id_hocky');
            $table -> foreign('id_hocky')->references('id')->on('hocky')->onDelete('cascade');
            $table -> unsignedInteger('id_hocvien');
            $table -> foreign('id_hocvien')->references('id')->on('hocvien')->onDelete('cascade');
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
        Schema::drop('bangdiem');
    }
}
