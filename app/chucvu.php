<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chucvu extends Model
{
    //
    protected $table = 'chucvu';
    public $timestamps = false;

    public function chucnang(){
        return $this -> belongsTo('App\chucnang','id_chucnang','id');
    }

    public function cvht(){
        return $this -> hasMany('App\cvht','id_chucvu','id');
    }

    public function bangdiem_yeucau(){
        return $this -> hasManyThrough('App\bangdiem_yeucau','App\cvht',
            'id_chuvu','id_cvht','id');
    }

    public function bithu(){
        return $this -> hasMany('App\bithu','id_chucvu','id');
    }


    public function hocvien(){
        return $this -> hasMany('App\hocvien','id_chucvu','id');
    }

    public function bangdiem(){
        return $this -> hasManyThrough('App\bangdiem','App\hocvien',
            'id_chucvu','id_hocvien','id');
    }
}
