<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chucnang_hk extends Model
{
    //
    protected $table = 'chucnang_hk';
    public $timestamps = false;

    public function hocky(){
        return $this -> belongsTo('App\hocky','id_hocky','id');
    }

    public function chucnang(){
        return $this -> belongsTo('App\chucnang','id_chucnang','id');
    }

    public function chucvu(){
        return $this -> hasMany('App\chucvu','id_chucnang_hk','id');
    }

    public function bithu(){
        return $this -> hasManyThrough('App\bithu','App\chucvu',
            'id_chucnang_hk','id_chucvu','id');
    }

    public function hocvien(){
        return $this -> hasManyThrough('App\hocvien','App\chucvu',
            'id_chucnang_hk','id_chucvu','id');
    }

    public function cvht(){
        return $this -> hasManyThrough('App\cvht','App\chucvu',
            'id_chucnang_hk','id_chucvu','id');
    }

}
