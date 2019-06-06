<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BangdiemYeucau extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('bangdiem_yeucau',function ($table){
            $table -> increments('id');
            $table -> integer('1_a_1')->nullable($value = true);
            $table -> integer('1_a_2')->nullable($value = true);
            $table -> integer('1_a_3')->nullable($value = true);
            $table -> integer('1_a_4')->nullable($value = true);
            $table -> integer('chungchi_a')->nullable($value = true);
            $table -> integer('chungchi_b')->nullable($value = true);
            $table -> integer('chungchi_c')->nullable($value = true);
            $table -> integer('toeic')->nullable($value = true);
            $table -> integer('2_1')->nullable($value = true);
            $table -> integer('2_2_1')->nullable($value = true);
            $table -> integer('2_2_2')->nullable($value = true);
            $table -> integer('3_1')->nullable($value = true);
            $table -> integer('3_2_1')->nullable($value = true);
            $table -> integer('3_2_2')->nullable($value = true);
            $table -> integer('3_3_1')->nullable($value = true);
            $table -> integer('3_3_2')->nullable($value = true);
            $table -> integer('3_3_3')->nullable($value = true);
            $table -> integer('4_1')->nullable($value = true);
            $table -> integer('4_2')->nullable($value = true);
            $table -> integer('4_3')->nullable($value = true);
            $table -> integer('5_1')->nullable($value = true);
            $table -> integer('5_2')->nullable($value = true);
            $table -> integer('5_3')->nullable($value = true);

            $table -> unsignedInteger('id_bangdiem');
            $table -> foreign('id_bangdiem')->references('id')->on('bangdiem') -> onDelete('cascade');

            $table -> unsignedInteger('id_cvht');
            $table -> foreign('id_cvht')->references('id')->on('cvht') -> onDelete('cascade');

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
        Schema::drop('bangdiem_yeucau');
    }
}
