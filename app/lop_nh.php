<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lop_nh extends Model
{
    //
    protected $table = 'lop_nh';
    public $timestamps = false;

    public function namhoc(){
        return $this -> belongsTo('App\namhoc','id_nh','id');
    }

    public function lop(){
        return $this -> belongsTo('App\lop','id_lop','id');
    }

}
