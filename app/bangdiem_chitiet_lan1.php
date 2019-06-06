<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bangdiem_chitiet_lan1 extends Model
{
    //
    protected $table = 'bangdiem_chitiet_lan1';
    public $timestamps = false;

    public function bangdiem(){
        return $this -> belongsTo('App\bangdiem','id_bangdiem','id');
    }
}
