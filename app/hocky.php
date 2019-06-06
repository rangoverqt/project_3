<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hocky extends Model
{
    //
    protected $table = 'hocky';
    public $timestamps = false;

    public function namhoc(){
        return $this -> belongsTo('App\namhoc','id_namhoc','id');
    }

    public function hoatdong_hk_lop(){
        return $this -> hasMany('App\hoatdong_hk_lop','id_hocky','id');
    }

    public function chucnang_hk(){
        return $this -> hasMany('App\chucnang_hk','id_hocky','id');
    }

    public function chucvu(){
        return $this -> hasManyThrough('App\chucvu','App\chucnang_hk',
            'id_hocky','id_chucnang_hk');
    }

    public function bangdiem(){
        return $this -> hasMany('App\bangdiem','id_hocky','id');
    }

    public function bangdiem_chitiet(){
        return $this -> hasManyThrough('App\bangdiem_chitiet','App\bangdiem',
            'id_hocky','id_bangdiem','id');
    }

    public function bangdiem_yeucau(){
        return $this -> hasManyThrough('App\bangdiem_yeucau','App\bangdiem',
            'id_hocky','id_bangdiem','id');
    }

    public function phienlamviec(){
        return $this -> hasOne('App\phienlamviec','id_hocky','id');
    }

}
