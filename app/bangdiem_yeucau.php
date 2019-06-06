<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bangdiem_yeucau extends Model
{
    //
    protected $table = 'bangdiem_yeucau';
    public $timestamps = false;

    public function bangdiem(){
        return $this -> belongsTo('App\bangdiem','id_bangdiem','id');
    }

    public function bangdiem_lan1(){
        return $this -> belongsTo('App\bangdiem_lan1','id_bangdiem_lan1','id');
    }
}
