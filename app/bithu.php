<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class bithu extends  Authenticatable
{
    use Notifiable;
    //
    protected $table = 'bithu';
    public $timestamps = false;
    public $fillable = ['id','hoten','ten_dn','password','sdt','emai','ngay_sinh','id_chucvu','id_khoa'];
    protected $hidden = ['null'];

    public function khoa(){
        return $this -> belongsTo('App\khoa','id_khoa','id');
    }

    public function chucvu(){
        return $this -> belongsTo('App\chucvu','id_chucvu','id');
    }
}
