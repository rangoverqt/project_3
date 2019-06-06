<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hoatdong extends Model
{
    //
    protected $table = 'hoatdong';
    public $timestamps = false;

    public function hoatdong_nh_lop(){
        return $this -> hasMany('App\hoatdong_nh_lop','id_hoatdong','id');
    }

    public function phieu_dd(){
        return $this -> hasMany('App\phieu_dd','id_hoatdong','id');
    }

    public function thanhtich(){
        return $this -> hasMany('App\thanhtich','id_hoatdong','id');
    }
}
