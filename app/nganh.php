<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nganh extends Model
{
    //
    protected $table = 'nganh';
    public $timestamps = false;

    public function khoa(){
        return $this -> belongsTo('App\khoa','id_khoa','id');
    }

    public function lop(){
        return $this -> hasMany('App\lop','id_nganh','id');
    }

    public function hocvien(){
        return $this -> hasManyThrough('App\hocvien','App\lop',
            'id_nganh','id_lop','id');
    }

    public function cvht(){
        return $this -> hasManyThrough('App\cvht','App\lop',
            'id_nganh','id_lop','id');
    }

    public function lop_nh(){
        return $this -> hasManyThrough('App\lop_nh','App\lop',
            'id_nganh','id_lop','id');
    }

    public function hoatdong_nh_lop(){
        return $this -> hasManyThrough('App\hoatdong_nh_lop','App\lop',
            'id_nganh','id_lop','id');
    }
}
