<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BangdiemChitiet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('bangdiem_chitiet',function ($table){
            $table -> increments('id');
            $table -> integer('p1_a_1')->nullable($value = true);
            $table -> integer('p1_a_2')->nullable($value = true);
            $table -> integer('p1_a_3')->nullable($value = true);
            $table -> integer('p1_a_4')->nullable($value = true);
            $table -> integer('chungchi_a')->nullable($value = true);
            $table -> integer('chungchi_b')->nullable($value = true);
            $table -> integer('chungchi_c')->nullable($value = true);
            $table -> integer('toeic')->nullable($value = true);
            $table -> integer('p2_1')->nullable($value = true);
            $table -> integer('p2_2_1')->nullable($value = true);
            $table -> integer('p2_2_2')->nullable($value = true);
            $table -> integer('p3_1')->nullable($value = true);
            $table -> integer('p3_2_1')->nullable($value = true);
            $table -> integer('p3_2_2')->nullable($value = true);
            $table -> integer('p3_3_1')->nullable($value = true);
            $table -> integer('p3_3_2')->nullable($value = true);
            $table -> integer('p3_3_3')->nullable($value = true);
            $table -> integer('p4_1')->nullable($value = true);
            $table -> integer('p4_2')->nullable($value = true);
            $table -> integer('p4_3')->nullable($value = true);
            $table -> integer('p5_1')->nullable($value = true);
            $table -> integer('p5_2')->nullable($value = true);
            $table -> integer('p5_3')->nullable($value = true);

            $table -> unsignedInteger('id_bangdiem');
            $table -> foreign('id_bangdiem')->references('id')->on('bangdiem') -> onDelete('cascade');

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
        Schema::drop('bangdiem_chitiet');
    }
}
