<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lop extends Model
{
    //
    protected $table = 'lop';
    public $timestamps = false;

    public function nganh(){
        return $this -> belongsTo('App\nganh','id_nganh','id');
    }

    public function lop_nh(){
        return $this -> hasMany('App\lop_nh','id_lop','id');
    }

    public function hocvien(){
        return $this -> hasMany('App\hocvien','id_lop','id');
    }

    public function bangdiem(){
        return $this -> hasManyThrough('App\bangdiem','App\hocvien',
            'id_lop','id_hocvien','id');
    }

    public function phieu_dd(){
        return $this -> hasManyThrough('App\phieu_dd','App\hocvien',
            'id_lop','id_hocvien','id');
    }

    public function thanhtich(){
        return $this -> hasManyThrough('App\thanhtich','App\hocvien',
            'id_lop','id_hocvien','id');
    }

    public function hoatdong_nh_lop(){
        return $this -> hasMany('App\hoatdong_nh_lop','id_lop','id');
    }

    public function cvht(){
        return $this -> hasOne('App\cvht','id_lop','id');
    }
    public function bangdiem_yeucau(){
        return $this -> hasManyThrough('App\bangdiem_yeucau','App\cvht',
            'id_lop','id_cvht','id');
    }
}
