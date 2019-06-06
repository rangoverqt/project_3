<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chucnang extends Model
{
    //
    protected $table = 'chucnang';
    public $timestamps = false;

    public function chucnang_hk(){
        return $this -> hasMany('App\chucnang_hk','id_chucnang','id');
    }

    public function chucvu(){
        return $this -> hasManyThrough('App\chucvu','App\chucnang_hk',
            'id_chucnang','id_chucnang_hk');
    }


}
