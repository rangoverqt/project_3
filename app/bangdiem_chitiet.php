<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bangdiem_chitiet extends Model
{
    //
    protected $table = 'bangdiem_chitiet';
    public $timestamps = false;

    public function bangdiem(){
        return $this -> belongsTo('App\bangdiem','id_bangdiem','id');
    }
}
