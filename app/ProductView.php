<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ProductView extends Model
{
    //

    protected $table = "product_views";


    public function products(){
        return $this->belongsTo('App\Product');
    }


    public static function createViewLog($product) {

        $productViews= new ProductView;
        $productViews->product_id = $product->id;
        $productViews->url = \Request::url();
        $productViews->session_id = \Request::getSession()->getId();
        //$productViews->user_id = (\Auth::check())?\Auth::id():null; //this check will either put the user  id or null, no need to use \Auth()->user()->id as we have an inbuild function to get auth id
        $productViews->ip = \Request::getClientIp();
        $productViews->agent = \Request::header('User-Agent');

        //($productViews->post_id);
        $view = ProductView::where([['session_id',$productViews->session_id],['product_id',$productViews->product_id]])->first();
        if(!$view){
            $productViews->save();
        }
    }


}
