<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lydo_yeucau extends Model
{
    //
    protected $table = 'lydo_yeucau';
    public $timestamps = false;

    public function bangdiem_yeucau(){
        return $this -> belongsTo('App\bangdiem_yeucau','id_bangdiem_yeucau','id');
    }
}
