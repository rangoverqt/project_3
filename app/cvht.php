<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class cvht extends Authenticatable
{
    use Notifiable;
    //

    protected $table = 'cvht';
    public $timestamps = false;
    public $fillable = ['id','hoten','ten_dn','password','sdt','emai','ngay_sinh','id_chucvu'];
    protected $hidden = ['null'];

    public function lop(){
        return $this -> belongsTo('App\lop','id_lop','id');
    }

    public function chucvu(){
        return $this -> belongsTo('App\chucvu','id_chucvu','id');
    }

    public function bangdiem_yeucau(){
        return $this -> hasMany('App\bangdiem_yeucau','id_cvht','id');
    }
}
