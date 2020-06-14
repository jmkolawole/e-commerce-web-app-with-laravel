<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    //
    public function picture(){
        return $this->belongsTo('App\Product');
    }
}
