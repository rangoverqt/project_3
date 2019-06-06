<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phienlamviec extends Model
{
    //
    protected $table = 'phienlamviec';
    public $timestamps = false;

    public function hocky(){
        return $this -> belongsTo('App\hocky','id_hocky','id');
    }

    public function namhoc(){
        return $this -> belongsTo('App\namhoc','id_namhoc','id');
    }
}
