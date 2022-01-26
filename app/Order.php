<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = "orders";
    
    public function orders(){
        return $this->hasMany('App\OrdersProduct','order_id');
    }
}
