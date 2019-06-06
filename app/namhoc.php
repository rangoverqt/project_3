<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class namhoc extends Model
{
    //
    protected $table = 'namhoc';
    public $timestamps = false;

    public function hocky(){
        return $this -> hasMany('App\hocky','id_namhoc','id');
    }

    public function bangdiem(){
        return $this -> hasManyThrough('App\bangdiem','App\hocky',
            'id_namhoc','id_hocky','id');
    }

    public function hoatdong_hk_lop(){
        return $this -> hasManyThrough('App\hoatdong_hk_lop','App\hocky',
            'id_namhoc','id_hocky','id');
    }

    public function chucnang_hk(){
        return $this -> hasManyThrough('App\chucnang_hk','App\hocky',
            'id_namhoc','id_hocky','id');
    }

    public function lop_nh(){
        return $this -> hasMany('App\lop_nh','id_nh','id');
    }

    public function phienlamviec(){
        return $this -> hasOne('App\phienlamviec','id_namhoc','id');
    }

}
