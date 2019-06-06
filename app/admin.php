<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class admin extends Authenticatable
{
    //
    use Notifiable;

    protected $table = 'admin';
    public $timestamps = false;
    public $fillable = ['id','hoten','ten_dn','password','sdt','emai','ngay_sinh'];
    protected $hidden = ['null'];
}
