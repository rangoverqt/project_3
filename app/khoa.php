<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class khoa extends Model
{
    //
    protected $table = 'khoa';
    public $timestamps = false;

    public function nganh(){
        return $this -> hasMany('App\nganh','id_khoa','id');
    }

    public function lop(){
        return $this -> hasManyThrough('App\lop','App\nganh',
            'id_khoa','id_nganh','id');
    }

    public function bithu(){
        return $this -> hasMany('App\bithu','id_khoa','id');
    }
}
