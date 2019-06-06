<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hoatdong_hk_lop extends Model
{
    //
    protected $table = 'hoatdong_hk_lop';
    public $timestamps = false;

    public function hocky(){
        return $this -> belongsTo('App\hocky','id_hocky','id');
    }

    public function hoatdong(){
        return $this -> belongsTo('App\hoatdong','id_hoatdong','id');
    }

    public function lop(){
        return $this -> belongsTo('App\lop','id_lop','id');
    }
}
