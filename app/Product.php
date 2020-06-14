<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function brand(){
        return $this->belongsTo('App\Brand');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function pictures(){
        return $this->hasMany('App\Picture');
    }


    public function attributes(){
        return $this->hasMany('App\Attribute','product_id');
    }

    public function productViews(){
        return $this->hasMany('App\ProductView');
    }

    public function reviews(){
        return $this->hasMany('App\Review','product_id');
    }

}
