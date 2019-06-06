<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bangdiem extends Model
{
    //
    protected $table = 'bangdiem';
    public $timestamps = false;

    public function hocky(){
        return $this -> belongsTo('App\hocky','id_hocky','id');
    }

    public function hocvien(){
        return $this -> belongsTo('App\hocvien','id_hocvien','id');
    }

    public function bangdiem_chitiet(){
        return $this -> hasOne('App\bangdiem_chitiet','id_bangdiem','id');
    }

    public function bangdiem_yeucau(){
        return $this -> hasMany('App\bangdiem_yeucau','id_bangdiem','id');
    }
}
