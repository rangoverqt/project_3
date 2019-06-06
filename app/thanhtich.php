<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class thanhtich extends Model
{
    //
    protected $table = 'thanhtich';
    public $timestamps = false;

    public function hocvien(){
        return $this -> belongsTo('App\hocvien','id_hocvien','id');
    }

    public function hoatdong(){
        return $this -> belongsTo('App\hoatdong','id_hoatdong','id');
    }
}
