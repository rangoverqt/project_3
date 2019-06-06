<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class hocvien extends Authenticatable
{
    use Notifiable;
    //
    protected $table = 'hocvien';
    public $timestamps = false;
    public $fillable = ['id','hoten','mssv','password','sdt','emai','ngay_sinh','id_chucvu'];
    protected $hidden = ['null'];

    public function lop(){
        return $this -> belongsTo('App\lop','id_lop','id');
    }

    public function chucvu(){
        return $this -> belongsTo('App\chucvu','id_chucvu','id');
    }

    public function bangdiem(){
        return $this -> hasMany('App\bangdiem','id_hocvien','id');
    }

    public function bangdiem_chitiet(){
        return $this -> hasManyThrough('App\bangdiem_chitiet','App\bangdiem',
            'id_hocvien','id_bangdiem','id');
    }

    public function bangdiem_yeucau(){
        return $this -> hasManyThrough('App\bangdiem_yeucau','App\bangdiem',
            'id_hocvien','id_bangdiem','id');
    }

    public function phieu_dd(){
        return $this -> hasMany('App\phieu_dd','id_hocvien','id');
    }

    public function thanhtich(){
        return $this -> hasMany('App\thanhtich','id_hocvien','id');
    }
}
