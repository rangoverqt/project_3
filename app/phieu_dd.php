<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phieu_dd extends Model
{
    //
    protected $table = 'phieu_dd';
    public $timestamps = false;

    public function hocvien(){
        return $this -> belongsTo('App\hocvien','id_hocvien','id');
    }

    public function hoatdong(){
        return $this -> belongsTo('App\hoatdong','id_hoatdong','id');
    }
}
