<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hocky extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('hocky',function ($table){
            $table -> increments('id');
            $table -> string('hocky',1);

            $table->unsignedInteger('id_namhoc');

            $table->foreign('id_namhoc')->references('id')->on('namhoc')->onDelete('cascade');
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
        Schema::drop('hocky');
    }
}
