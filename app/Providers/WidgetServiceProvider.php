<?php

namespace App\Providers;

use App\Brand;
use App\Category;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use View;
use App\Product;

class WidgetServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //

        $categories = Category::where('parent_id', '=', 0)->where('status', 1)->get();
        $category_count = $categories->count();


        $brands = Brand::where('status', 1)->get();


        $colorsArray = Product::select('product_color')->groupBy('product_color')->get();
        $colorsArray = json_decode(json_encode($colorsArray), true);

        $colorsArray = $this->array_flat($colorsArray);

        $order_items = Order::where('order_status', '=', 'New')->get();
        $order_count = Order::where('order_status', '=', 'New')->count();



        $cart_count = 0;


        view()->composer('frontend.layouts.header', function ($view) {
            $session_id = Session::get('session_id');

            $removed = "";

            if (Auth::guard('visitor')->check()) {
                //dd('yes');
                $user_id = Auth::guard('visitor')->user()->id;
                $cart_products = DB::table('carts')->where(['user_id' => $user_id])->orderBy('id', 'desc')->get();
                //$cart_count = DB::table('carts')->where(['user_id'=>$user_id])->orderBy('id','desc')->count();
                $cart_count = 0;
                foreach ($cart_products as $cart_product) {
                    $items = Product::where('id', $cart_product->product_id)->first();

                    if ($items) {
                        $cart_count =  $cart_count + 1;
                    } else {
                        $removed = "yes";
                    }
                }
            } else {
                $cart_products = DB::table('carts')->where('session_id', $session_id)
                    ->where('session_id', '<>', null)->orderBy('id', 'desc')->get();
                $cart_count = 0;
                foreach ($cart_products as $cart_product) {
                    $items = Product::where('id', $cart_product->product_id)->first();

                    if ($items) {
                        $cart_count =  $cart_count + 1;
                    } else {
                        $removed = "yes";
                    }
                }

                /*
                $cart_count = DB::table('carts')->where('session_id',$session_id)
                    ->where('session_id','<>',null)->orderBy('id','desc')->count();
                */
            }




            $view->with('cart_count', $cart_count);
            $view->with('cart_products', $cart_products);

            if ($removed == "yes") {
                Session::flash('failure', 'One Or More Of The Items Is/Are Not Available In The Requested Quantity. Please Re-add Items To Your Cart!');
            }
        });






        View::share('cart_count', $cart_count);

        View::share('cat_count', $category_count);
        View::share('categories', $categories);


        View::share('brands', $brands);

        View::share('colorsArray', $colorsArray);



        View::share('order_count', $order_count);

        View::share('order_items', $order_items);
    }

    function array_flat($array)
    {
        $newArray = array();
        foreach ($array as $subArray) {
            foreach ($subArray as $value) {
                $newArray[] = $value;
            }
        }

        return $newArray;
    }
}
