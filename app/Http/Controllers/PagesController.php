<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Banner;
use App\BillingAddress;
use App\Brand;
use App\Category;
use App\Country;
use App\Coupon;
use App\DeliveryAddress;
use App\DeliveryAddresses;
use App\Jobs\sendAdminInvoice;
use App\Jobs\sendAdmInvoice;
use App\Jobs\sendUserInvoice;
use App\Mail\AdminInvoice;
use App\Mail\AdmInvoice;
use App\Mail\Newletters;
use App\Mail\UserInvoice;
use App\Order;
use App\OrdersProduct;
use App\Picture;
use App\Product;
use App\ProductsAttribute;
use App\ProductView;
use App\Review;
use App\Subscriber;
use App\Team;
use App\Testimony;
use App\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
//use App\Mail\Subscriber;

class PagesController extends Controller
{
    //
    public function home(){


        if(Auth::guard('visitor')->check()) {
            $user_id = Auth::guard('visitor')->user()->id;
            //dd($user_id);
        }


        $new_arrivals = Product::where('status',1)->orderBy('id','desc')->take(6)->get();
        $new_arrivals2 = Product::where('status',1)->orderBy('id','desc')->skip(6)->take(6)->get();
        $arrival_count = $new_arrivals->count();
        $banners = Banner::where('id',1)->first();
        $groups = Category::with('products')->where('parent_id',0)->withCount('products')->orderBy('products_count','desc')->take(4)->get();
        $specials = Product::where('featured',1)->orderBy('id','desc')->take(6)->get();


        $populars = Product::where("created_at", ">=", date("Y-m-d H:i:s", strtotime('-24 weeks', time())))
            ->where('status',1)->withCount('productviews')->orderBy('productviews_count', 'desc')->limit(6)
            ->get();

        $bestSellers = OrdersProduct::select('product_id')->groupBy('product_id')->orderByRaw('COUNT(*) DESC')->limit(6)->get();

        $testimonies = Testimony::orderBy('id','desc')->take(6)->get();

        return view('frontend.pages.home')->with(compact('new_arrivals','groups','specials','testimonies','arrival_count',
            'banners','new_arrivals2','populars','bestSellers'));
    }

    public function about(){

        $teams = Team::orderBy('id','asc')->take(4)->get();
       return view('frontend.pages.about')->with(compact('teams'));
    }


    public function contact(Request $request){

        if($request->isMethod('post')){
            $this->validate($request,[
                'email' => 'required|email',
                'subject'=>'min:3',
                'name'=>'min:3',
                'message'=> 'min:10',
            ]);


            $data = array(
                'email' => $request->email,
                'name' => $request->name,
                'subject' => $request->subject,
                'bodyMessage' => $request->message
            );




            Mail::send('emails.contact_us',$data,function($message) use ($data){

                $message->from($data['email']);
                $message->to('support@alvinsmakeup.com');
                $message->subject($data['subject']);
            });

            Session::flash('success', ' Message Sent!');

            return \redirect()->route('home');

        }

        return view('frontend.pages.contact');
    }

    public function product($url){



        $product = Product::with('pictures')->where('url',$url)->where('status',1)->first();


        if ($product){

            $status = "";
            if ($product->stock_status == "yes"){
                $item = Attribute::where('product_id',$product->id)->get();
                if($item->count() == 0){
                   $status = "yes";
                }
            }



            if($status == "yes"){
                abort(404);
            }


                $id = $product->id;

                $rating = Review::where('product_id',$id)->where('approve',1)->avg('rating');
                $rating = ceil($rating);
                $rating_count = Review::where('product_id',$id)->where('approve',1)->count();

                $ratings = Review::where('product_id',$id)->where('approve',1)->orderBy('id','desc')->get();

                //$count = Product::with('pictures')->find($id)->count();
                ProductView::createViewLog($product);
                $relatedProducts = Product::where('id','!=',$id)->where('category_id',$product->category_id)->take(6)->get();
                return view('frontend.pages.product')->with(compact('product','relatedProducts','rating_count','rating','ratings'));


        }else{
                abort(404);
        }

    }

    public function category($url){

        $category = Category::where('url',$url)->where('status',1)->first();
        $count = Category::where('url',$url)->where('status',1)->count();

        if($count == 0){
            abort(404);
        }


        $niche = Category::where('id',$category->parent_id)->first();
        if($niche->status == 0){
            abort(404);
        }

        $products = Product::where('category_id',$category->id)->orderBy('id','desc')->paginate(12);


        if(!empty($_GET['minPrice'])){
            $minPrice = $_GET['minPrice'];
            $maxPrice = $_GET['maxPrice'];

            $products = Product::where('category_id',$category->id)->where('price','>=',$minPrice)->where('price','<=',$maxPrice)->orderBy('id','desc')->paginate(12);
        }

        if(!empty($_GET['price'])){

            $price = 50000;

            $products = Product::where('category_id',$category->id)->where('price','>=',$price)->orderBy('id','desc')->paginate(12);


        }





        return view('frontend.pages.listing')->with(compact('category','products','niche','url'));


    }

    function array_flat($array){
        $newArray = array();
        foreach($array as $subArray){
            foreach($subArray as $value){
                $newArray[] = $value;
            }
        }

        return $newArray;
    }

    public function niche($url){
        $niche = Category::where('url',$url)->where('status',1)->first();
        $count = Category::where('url',$url)->where('status',1)->count();

        if($count == 0){
            abort(404);
        }
        $products = Product::where('niche_id',$niche->id)->orderBy('id','desc')->paginate(12);


        $niche_protect = "";


        if(!empty($_GET['minPrice'])){
            $minPrice = $_GET['minPrice'];
            $maxPrice = $_GET['maxPrice'];

            $products = Product::where('niche_id',$niche->id)->where('price','>=',$minPrice)->where('price','<=',$maxPrice)->orderBy('id','desc')->paginate(12);
        }

        if(!empty($_GET['price'])){

            $price = 50000;

            $products = Product::where('niche_id',$niche->id)->where('price','>=',$price)->orderBy('id','desc')->paginate(12);

        }

       return view('frontend.pages.niche')->with(compact('niche','products','url','niche_protect'));

    }


    public function brand($url){
        $brand = Brand::where('url',$url)->where('status',1)->first();
        $count = Brand::where('url',$url)->where('status',1)->count();

        if($count == 0){
            abort(404);
        }
        $products = Product::where('brand_id',$brand->id)->orderBy('id','desc')->paginate(12);


        if(!empty($_GET['minPrice'])){
            $minPrice = $_GET['minPrice'];
            $maxPrice = $_GET['maxPrice'];

            $products = Product::where('brand_id',$brand->id)->where('price','>=',$minPrice)->where('price','<=',$maxPrice)->orderBy('id','desc')->paginate(12);
        }

        if(!empty($_GET['price'])){

            $price = 50000;

            $products = Product::where('brand_id',$brand->id)->where('price','>=',$price)->orderBy('id','desc')->paginate(12);


        }


        return view('frontend.pages.brand')->with(compact('brand','products','url'));

    }


    public function filter(Request $request){

        $data = $request->all();
        $finalUrl = "";




        if(isset($data['priceFilter']) && !empty($data['priceFilter'])){

            $min_price = "";
            $max_price = "";
            $priceUrl = "";


            if(isset($data['priceFilter'])){
                if(!empty($data['priceFilter'])){

                 if($data['priceFilter'] == '50000upwards'){
                     $priceUrl = "?price=50000upwards";
                 }else{
                     $price = $data['priceFilter'];
                     $price = explode('-',$price);

                     $min_price = $price[0];
                     $max_price = $price[1];
                     $priceUrl = "?minPrice=".$min_price."&maxPrice=".$max_price;
                 }


                }
            }


            }



            $finalUrl = $data['url'].$priceUrl;






        return redirect::to($finalUrl);

    }

    public function products(){



        $products = Product::where('status',1)->orderBy('id','desc')->paginate(12);
        $url = 'products';
        $products_protect = "";



        if(!empty($_GET['minPrice'])){

            $minPrice = $_GET['minPrice'];
            $maxPrice = $_GET['maxPrice'];

            $products = Product::where('price','>=',$minPrice)->where('price','<=',$maxPrice)->where('status',1)->orderBy('id','desc')->paginate(12);
        }

        if(!empty($_GET['price'])){

            $price = 50000;

            $products = Product::where('price','>=',$price)->orderBy('id','desc')->paginate(12);


        }


        /*
        if(!empty($_GET['minPrice']) && !empty($_GET['color'])){
            $colorArray = explode('=',$_GET['color']);
            $minPrice = $_GET['minPrice'];
            $maxPrice = $_GET['maxPrice'];
            $products = Product::where('price','>=',$minPrice)->where('price','<=',$maxPrice)->whereIn('product_color',$colorArray)->orderBy('id','desc')->paginate(12);
        }
        */

        return view('frontend.pages.products')->with(compact('products','url','products_protect'));
    }



    public function makeupSpecial(){
        $products = Product::where('featured',1)->where('status',1)->orderBy('id','desc')->paginate(12);
        $url = 'makeupSpecial';
        $makeupSpecialProtect = "";
        if(!empty($_GET['minPrice'])){

            $minPrice = $_GET['minPrice'];
            $maxPrice = $_GET['maxPrice'];

            $products = Product::where('featured',1)->where('price','>=',$minPrice)->where('price','<=',$maxPrice)->where('status',1)->orderBy('id','desc')->paginate(12);

        }

        if(!empty($_GET['price'])){

            $price = 50000;

            $products = Product::where('featured',1)->where('price','>=',$price)->where('status',1)->orderBy('id','desc')->paginate(12);


        }

        return view('frontend.pages.makeupSpecial')->with(compact('products','url','makeupSpecialProtect'));
    }


    public function getProductType(Request $request){

        $data = $request->all();
        //echo "<pre>";print_r($data);die;
        $proArr = explode("#",$data['idSize']);
        $proAttr = Attribute::where(['product_id' => $proArr[0], 'color' => $proArr[1]])->first();
        echo $proAttr->stock.'#';
        echo $proAttr->color.'#';
        echo '<button class="pro-cart" id="product-cart" onclick="addToCart(';echo $proArr[0] .')">add to cart</button>';
        //echo "<pre>";print_r($proAttr->stock);die;
    }



    public function checkSubscriberEmail(Request $request){

        if($request->ajax()){
            $data = $request->all();
            $subscriber_count = Subscriber::where('email',$data['subscriber_email'])->count();
            if($subscriber_count > 0){

                echo 'exists';
            }
        }
    }


    public function addSubscriberEmail(Request $request){

        if($request->ajax()){
            $data = $request->all();
            $subscriber_count = Subscriber::where('email',$data['subscriber_email'])->count();
            if($subscriber_count > 0){

                echo 'exists';
            }else{
                $token = Str::random(32);
                $subscriber = new Subscriber();
                $subscriber->email = $data['subscriber_email'];
                $subscriber->status = 0;
                $subscriber->save();
                DB::table('verify_subscribers')->insert(['email' => $subscriber->email, 'token' => $token, 'created_at' => new Carbon]);
                //trigger mail
                Mail::to($subscriber->email)->send(new \App\Mail\Subscriber($subscriber, $token));
                echo 'saved';
            }
        }

    }


    public function verifySubscriber($email,$token){
        $subscriber = DB::table('verify_subscribers')->where('email','=',$email)->where('token','=',$token)->first();
        $verified_subscriber = Subscriber::where('email','=',$subscriber->email)->first();
        if(!$verified_subscriber){

        }
        else{
            $verified_subscriber->status = 1;
            $verified_subscriber->update();
            DB::table('verify_subscribers')->where('email', $verified_subscriber->email)->delete();
            Session::flash('success', ' Email Verified Successfully!');
            return redirect()->route('home');
        }
    }


    public function search(Request $request){


        $data = $request['product'];
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        $search_product = $data;
        $products = Product::where('product_name','like','%'.$search_product.'%')->orWhere('description',$search_product)
            ->where('status',1)->orderBy('id','desc')->paginate(12);
        $count_search = $products->count();

        return view('frontend.pages.search')->with(compact('categories','products','search_product','count_search'));

    }


    public function addToCart(Request $request, $id)
    {

        if($request->ajax()){
            $data = $request->all();
            $user_id = "";
            $session_id = "";

            if(Auth::guard('visitor')->check()) {
                $user_id = Auth::guard('visitor')->user()->id;
                $session_id = null;

                $stock = 0;
                $product = Product::with('attributes')->where('id',$id)->where('status',1)->first();


                if ($product){


                if($product->stock_status == "no"){
                    $stock = $product->stock;
                }else{
                    $pro = Attribute::where('id',$data['attrId'])->where('product_id',$id)->first();
                    $stock = $pro->stock;
                }

                $cart_count = DB::table('carts')->where('product_id',$id)->where('attribute_id',$data['attrId'])->
                where('user_id',$user_id)->count();
                if ($cart_count > 0){
                    echo "Exist";
                }else
                {
                    if($stock >= $data['quantity']){

                        DB::table('carts')->insert(['product_id' => $id, 'user_id' => $user_id, 'attribute_id' => $data['attrId'],'quantity' => $data['quantity'],
                            'price' => $data['price'],'product_name' => $data['product_name'], 'product_code' => $data['product_code'],
                            'product_color'=> $data['type'],'session_id'=> $session_id, 'created_at' => new Carbon, 'updated_at' => new Carbon]);

                        echo 'Saved';

                    }else{
                        echo "Not Available";

                    }
                }
                }else{
                    echo "Status";
                }

            }else{
                $user_id = null;
                $session_id = Session::get('session_id');

                if(empty($session_id)) {
                    $session_id = Str::random(40);
                    Session::put('session_id', $session_id);
                    $user_id = null;
                }




                    $stock = 0;
                    $product = Product::with('attributes')->where('id',$id)->where('status',1)->first();

                    if ($product){
                        $session_id = Session::get('session_id');

                        if($product->stock_status == "no"){
                            $stock = $product->stock;
                        }else{
                            $pro = Attribute::where('id',$data['attrId'])->where('product_id',$id)->first();
                            $stock = $pro->stock;
                        }

                        $cart_count = DB::table('carts')->where('product_id',$id)->where('attribute_id',$data['attrId'])->
                        where('session_id',$session_id)->count();
                        if ($cart_count > 0){
                            echo "Exist";
                        }else
                        {
                            if($stock >= $data['quantity']){

                                DB::table('carts')->insert(['product_id' => $id, 'user_id' => $user_id, 'attribute_id' => $data['attrId'],'quantity' => $data['quantity'],
                                    'price' => $data['price'],'product_name' => $data['product_name'], 'product_code' => $data['product_code'],
                                    'product_color'=> $data['type'],'session_id'=> $session_id, 'created_at' => new Carbon, 'updated_at' => new Carbon]);

                                echo 'Saved';

                            }else{
                                echo "Not Available";

                            }
                        }
                    }else{
                        echo "Status";
                    }
            }

        }

    }

    public function addToWishlist(Request $request, $id){
        if($request->ajax()){
            $data = $request->all();
            $user_id = "";
            if(Auth::guard('visitor')->check()) {
                $user_id = Auth::guard('visitor')->user()->id;
                $user = Visitor::where('id',$user_id)->first();
                $user_email = $user->email;

                $product = Product::where('id',$id)->where('status',1)->first();
                $status = $product->stock_status;
                if($status == "yes" && $data['attrId'] == 0) {
                    echo "Type";
                }else{

                    $wish_count = DB::table('wishlist')->where('product_id',$id)->where('attribute_id',$data['attrId'])->
                    where('user_id',$user_id)->count();

                    $cart_count = DB::table('carts')->where('product_id',$id)->where('attribute_id',$data['attrId'])->
                    where('user_id',$user_id)->count();


                    if($cart_count > 0){
                        echo "Cart";
                    }else{
                        if($wish_count > 0){
                            echo "Exist";
                        }else{
                            DB::table('wishlist')->insert(['product_id' => $id, 'user_id' => $user_id, 'attribute_id' => $data['attrId'],
                                'price' => $data['price'],'product_name' => $data['product_name'], 'product_code' => $data['product_code'],'user_email' => $user_email,
                                'created_at' => new Carbon, 'updated_at' => new Carbon]);
                            echo 'Saved';
                        }

                    }
                }



            }

        }

    }


    public function wishlist(){
        if(Auth::guard('visitor')->check()) {
            $user_id = Auth::guard('visitor')->user()->id;

            $products = DB::table('wishlist')->where('user_id',$user_id)->orderBy('id','desc')->get();

            return view('frontend.pages.wishlist')->with(compact('products'));

        }else{
            Session::flash('failure', ' You Have To Login To Access This Page!');
            return \redirect()->route('login.user');
        }

    }


    public function wishToCart(Request $request, $id){

        if($request->ajax()){
            $data = $request->all();

        if(Auth::guard('visitor')->check()){
            $product = Product::with('attributes')->where('id',$id)->where('status',1)->first();
            if(!$product){
               echo "Status";
            }
            $user_id = Auth::guard('visitor')->user()->id;

            if($product->stock_status == "no"){
                $stock = $product->stock;
            }else{
                $pro = Attribute::where('id',$data['attrId'])->where('product_id',$id)->first();
                $stock = $pro->stock;
            }


            $cart_count = DB::table('carts')->where('product_id',$id)->where('attribute_id',$data['attrId'])->
            where('user_id',$user_id)->count();
            if ($cart_count > 0){
                echo "Exist";
            }else {

                if($stock >= $data['quantity']) {
                    DB::table('carts')->insert(['product_id' => $id, 'user_id' => $user_id, 'attribute_id' => $data['attrId'], 'quantity' => $data['quantity'],
                        'price' => $data['price'], 'product_name' => $data['product_name'], 'product_code' => $data['product_code'],
                        'created_at' => new Carbon, 'updated_at' => new Carbon]);
                    echo "Saved";
                }else{
                    echo "Not Available";
                }
            }

        }


            }

    }



    public function deleteWish(Request $request, $id){
        if($request->ajax()){
            DB::table('wishlist')->where('id',$id)->delete();
            echo "deleted";
        }
    }


    public function cart(){

        //$userCart = "";
        if(Auth::guard('visitor')->check()) {
            $user_id = Auth::guard('visitor')->user()->id;

            $userCart = DB::table('carts')->where(['user_id'=>$user_id])->orderBy('id','desc')->get();
        }else{

            $session_id = Session::get('session_id');
            $userCart = DB::table('carts')->where('session_id',$session_id)->where('session_id','<>',null)->orderBy('id','desc')->get();
        }

            return view('frontend.pages.cart')->with(compact('userCart'));

    }


    public function addToCompare(Request $request, $id){
        if($request->ajax()){
            $data = $request->all();
            $user_id = "";
            if(Auth::guard('visitor')->check()) {
                $user_id = Auth::guard('visitor')->user()->id;
                $user = Visitor::where('id',$user_id)->first();
                $user_email = $user->email;


                $product = Product::where('id',$id)->where('status',1)->first();
                if(!$product){
                    echo "Status";
                }
                $status = $product->stock_status;
                if($status == "yes" && $data['attrId'] == 0){
                    echo "Type";
                }else{
                    $count = DB::table('compares')->where('user_id',$user_id)->count();
                    if($count >= 3){
                        echo "Max";
                    }else{
                        $compare_count = DB::table('compares')->where('product_id',$id)->where('attribute_id',$data['attrId'])->
                        where('user_id',$user_id)->count();



                        if($compare_count > 0){
                            echo "Exist";
                        }else{
                            DB::table('compares')->insert(['product_id' => $id, 'user_id' => $user_id, 'attribute_id' => $data['attrId'],
                                'price' => $data['price'],'product_name' => $data['product_name'], 'product_code' => $data['product_code'],
                                'created_at' => new Carbon, 'updated_at' => new Carbon]);
                            echo "Saved";
                        }
                    }
                }





            }
            else{
                echo "Not logged in";
            }
        }
    }



    public function compare(){

        if(Auth::guard('visitor')->check()) {
            $user_id = Auth::guard('visitor')->user()->id;

            $products = DB::table('compares')->where('user_id',$user_id)->orderBy('id','desc')->get();

            return view('frontend.pages.compare')->with(compact('products'));

        }else{
            Session::flash('failure', ' You Have To Login To Access This Page!');
            return \redirect()->route('login.user');
        }


    }

    public function compareToCart(Request $request, $id){

        if($request->ajax()){
            $data = $request->all();

            if(Auth::guard('visitor')->check()){
                $product = Product::with('attributes')->where('id',$id)->where('status',1)->first();
                if(!$product){
                    echo "Status";
                }
                $user_id = Auth::guard('visitor')->user()->id;

                if($product->stock_status == "no"){
                    $stock = $product->stock;
                }else{
                    $pro = Attribute::where('id',$data['attrId'])->where('product_id',$id)->first();
                    $stock = $pro->stock;
                }




                $cart_count = DB::table('carts')->where('product_id',$id)->where('attribute_id',$data['attrId'])->
                where('user_id',$user_id)->count();
                if ($cart_count > 0){
                    echo "Exist";
                }else {

                    if($stock >= $data['quantity']) {
                        DB::table('carts')->insert(['product_id' => $id, 'user_id' => $user_id, 'attribute_id' => $data['attrId'], 'quantity' => $data['quantity'],
                            'price' => $data['price'], 'product_name' => $data['product_name'], 'product_code' => $data['product_code'],
                            'created_at' => new Carbon, 'updated_at' => new Carbon]);
                        DB::table('wishlist')->where('user_id', $user_id)->where('attribute_id', $data['attrId'])->where('product_id', $id)->delete();
                        echo "Saved";
                    }else{
                        echo "Not Available";
                    }
                }

            }


        }

    }

    public function deleteCompare(Request $request,$id){
        if($request->ajax()){
            DB::table('compares')->where('id',$id)->delete();
            echo "deleted";
        }
    }


    public function addReview(Request $request,$id){

        if(Auth::guard('visitor')->check()) {
            $user_id = Auth::guard('visitor')->user()->id;
            $current_user_count = Review::where('product_id',$id)->where('user_id',$user_id)->count();

            if($current_user_count >= 1){
                Session::flash('failure', ' You Already Made A Review On This Product. Please, Edit Your Review!');
                return \redirect()->back();
            }else{
                $this->validate($request,[
                    'title'=>'required|min:5',
                    'body'=> 'min:5',
                ]);


                if($request->body == ""){
                    $body = "";
                }else{
                    $body = $request->body;
                }
                $title = $request->title;
                $rating = $request->rating;

                $review = new Review;
                $review->user_id  = $user_id;
                $review->product_id = $id;
                $review->body = $body;
                $review->title = $title;
                $review->rating = $rating;

                $review->save();
                Session::flash('success', ' Review Saved, Awaiting Approval!');
                return \redirect()->back();

            }



        }else{

            Session::flash('failure', ' You Have To Login To Access This Page!');
            return \redirect()->route('login.user');
        }


    }



    public function editReview(Request $request, $id, $item){

        if(Auth::guard('visitor')->check()) {
            $user_id = Auth::guard('visitor')->user()->id;

            $this->validate($request,[
                'title'=>'required|min:5',
                'body'=> 'min:5',
            ]);

            if($request->body == ""){
                $body = "";
            }else{
                $body = $request->body;
            }


            $review = Review::where('id', $item)->where('user_id', $user_id)->where('product_id', $id)->first();
            $review->product_id = $id;
            $review->user_id = $user_id;
            $review->rating = $request->rating;
            $review->body = $request->body;
            $review->title = $request->title;
            $review->approve = 0;

            $review->save();

            Session::flash('success', ' Review Updated, Awaiting Approval!');
            return \redirect()->back();

        }else{
            Session::flash('failure', ' Insufficient Permission!');
            return \redirect()->route('login.user');
        }

    }


    public function fetchCart(){

        if(Auth::guard('visitor')->check()) {
            $user_id = Auth::guard('visitor')->user()->id;
            $cart_products = DB::table('carts')->where(['user_id'=>$user_id])->orderBy('id','desc')->get();
            $cart_count = DB::table('carts')->where(['user_id'=>$user_id])->orderBy('id','desc')->count();
        }else{
            $session_id = Session::get('session_id');
            $cart_products = DB::table('carts')->where(['session_id'=>$session_id])->orderBy('id','desc')->get();
            $cart_count = DB::table('carts')->where(['session_id'=>$session_id])->orderBy('id','desc')->count();

        }


        if($cart_count != 0){
            $output = '';
            $total_amount = 0;
            $output .= '<a href="#">
                                    <span class="pe-7s-shopbag"></span>
                                    <span class="total-pro">'.$cart_count.'</span>
                                        </a>
                                        <ul class="ht-dropdown cart-box-width">
                                        <li><div style="max-height:300px!important;overflow-y: scroll!important;">';
        foreach ($cart_products as $product){

            $image = $image = Product::where('id',$product->product_id)->first();
            if($product->attribute_id != 0){
                $att = Attribute::where('id',$product->attribute_id)->first();
                $name = '<span class="">'.$att->color.'</span>';
            }else{
                $name = "";
            }



            $output .= '<div class="single-cart-box">';
            $output .= '<div class="cart-img">';
            $output .= '<a href="'. \route("product",$image->url).'"><img src="'.asset('images/backend/products/small/'.$image->image).'" alt="cart-image"></a>';
            $output .= '<span class="pro-quantity">'.$product->quantity.'</span></div>';
            $output .= '<div class="cart-content">';
            $output .= '<h6><a href="'. \route("product",$image->url).'">'. $product->product_name .'</a></h6>';
            $output .= '<span class="cart-price">₦'. $product->price.'</span>';
            $output .= $name;
            $output .= '</div></div>';


            $total_amount = $total_amount + ($product->price * $product->quantity);
        }
        $output .= '</div><div class="cart-footer">
                                                    <ul class="price-content">
                                                        
                                                        <li>Total
                                                            <span>₦'. $total_amount.'</span>
                                                        </li>
                                                    </ul>
                                                    <div class="cart-actions text-center">
                                                        <a class="cart-checkout" href='.route("cart").'>Open Cart</a>
                                                    </div>
                                                </div>
                                                </li></ul>';
        if($cart_count > 0){
        echo $output;
        }

        }

    }

    public function updateCartQuantity(Request $request){

        $id = $request->id;
        $quantity = $request->quantity;
        $cart_item = DB::table('carts')->where('id','=',$id)->first();
        $product_id = $cart_item->product_id;
        $product = Product::with('attributes')->where('id',$product_id)->first();

        $attribute = $cart_item->attribute_id;

        Session::put('attribute_id',$attribute);
        //$att = Session::get('attribute_id');


        $stock = 0;
        if($product->stock_status == "no"){
            $stock = $product->stock;
        }elseif ($product->stock_status == "yes"){
            $pro = Attribute::where('id',$cart_item->attribute_id)->where('product_id',$product_id)->first();
            $stock = $pro->stock;
        }

        if($stock >= $quantity){
            DB::table('carts')->where('id','=',$id)->update(['quantity'=>$quantity]);
            Session::flash('success', ' Cart Item Quantity Updated Successfully!');
        }else{
            Session::flash('failure', ' The Requested Quantity Is Not Available. Please Reduce The Quantity!');
        }


        return back();

    }


    public function removeCartItem(Request $request){
        $id = $request->cart_id;
        DB::table('carts')->where('id','=',$id)->delete();
        Session::flash('done', ' Cart Item Removed Successfully!');
        return back();
    }






    public function checkout(Request $request){
        $countries = Country::get();

        if(Auth::guard('visitor')->check()) {
            $user_id = Auth::guard('visitor')->user()->id;
            $userDetails = Visitor::where('id',$user_id)->first();
            $userCart = DB::table('carts')->where(['user_id'=>$user_id])->orderBy('id','desc')->get();
        }else{
            $userDetails = null;
            $session_id = Session::get('session_id');
            $userCart = DB::table('carts')->where('session_id',$session_id)->where('session_id','<>',null)->orderBy('id','desc')->get();
        }

        if($request->isMethod('post')){

            if($userCart->count() != 0) {
                $session_id = Session::get('session_id');
                $billing = new BillingAddress;

                if (Auth::guard('visitor')->check()) {
                    $user_id = Auth::guard('visitor')->user()->id;
                    $billing->user_id = $user_id;
                    $billing->session_id = null;
                } else {
                    $billing->user_id = null;
                    $billing->session_id = $session_id;
                }

                $shipping = new DeliveryAddress;
                if(Auth::guard('visitor')->check()){
                    $user_id = Auth::guard('visitor')->user()->id;
                    $shipping->user_id = $user_id;
                    $shipping->session_id = null;
                }else{
                    $shipping->user_id = null;
                    $shipping->session_id = $session_id;
                }

                if(!empty($request->billing_first_name) && !empty($request->billing_last_name && !empty($request->billing_address) && !empty($request->billing_town))
                    && !empty($request->billing_state) && !empty($request->billing_country )&& !empty($request->billing_email) && !empty($request->billing_phone) &&
                    !empty($request->shipping_first_name) && !empty($request->shipping_last_name) && !empty($request->shipping_address) && !empty($request->shipping_town)
                    &&  !empty($request->shipping_state) && !empty($request->shipping_country) && !empty($request->shipping_email) && !empty($request->shipping_phone)){


                    $billing->first_name = $request->billing_first_name;
                    $billing->last_name = $request->billing_last_name;
                    $billing->address = $request->billing_address;
                    $billing->town = $request->billing_town;
                    $billing->state = $request->billing_state;
                    $billing->country = $request->billing_country;
                    $billing->postcode = $request->billing_pincode;
                    $billing->email = $request->billing_email;
                    $billing->phone_number = $request->billing_phone;



                    $shipping->first_name = $request->shipping_first_name;
                    $shipping->last_name = $request->shipping_last_name;
                    $shipping->address = $request->shipping_address;
                    $shipping->town = $request->shipping_town;
                    $shipping->state = $request->shipping_state;
                    $shipping->country = $request->shipping_country;
                    $shipping->postcode = $request->shipping_pincode;
                    $shipping->email = $request->shipping_email;
                    $shipping->phone_number = $request->shipping_phone;

                    if(!empty($request->note)){
                        $shipping->note = $request->note;
                    }else {
                        $shipping->note = "";
                    }

                    $billing_array = collect([
                        $billing->session_id,$billing->user_id,$billing->first_name,
                        $billing->last_name,$billing->address,$billing->town,
                        $billing->state,$billing->country,$billing->postcode,
                        $billing->email, $billing->phone_number]);
                    Session::put('billing',$billing_array);

                    //$bill = Session::get('billing');



                    $shipping_array = collect([
                        $shipping->session_id,$shipping->user_id,$shipping->first_name,
                        $shipping->last_name,$shipping->address,$shipping->town,
                        $shipping->state,$shipping->country,$shipping->postcode,
                        $shipping->email, $shipping->phone_number,$shipping->note]);
                    Session::put('shipping',$shipping_array);



                   // Session::flash('failure','One Or More Of The Items Is/Are Not Available In The Requested Quantity. Please Re-add Items To Your Cart!');
                    return \redirect()->route('order.review');



                }else{
                    Session::flash('failure', ' Please Fill Out All Compulsory Fields!');
                    return back();
                }






            }
            else{
                Session::flash('failure', 'Please Add Items To Your Cart To Proceed!');
                return \redirect()->route('cart');
            }





        }



        return view('frontend.pages.checkout')->with(compact('userDetails','countries'));
    }



    public function orderReview(Request $request){

        $ship = Session::get('shipping');
        $bill = Session::get('billing');

        $billingDetails = $bill;
        $shippingDetails = $ship;



        $removed = "";


        if(Auth::guard('visitor')->check()){
            $alert = "";
            $user_id = Auth::guard('visitor')->user()->id;
            $cart_products = DB::table('carts')->where(['user_id'=>$user_id])->orderBy('id','desc')->get();
            foreach ($cart_products as $product){
                $id = $product->product_id;
                $item = Product::where('id',$id)->first();
                if ($item){
                    $stock = 0;
                    if($item->stock_status == "yes"){

                        $value = Attribute::where('id',$product->attribute_id)->where('product_id',$id)->first();
                        $stock = $value->stock;
                        $deleted = DB::table('carts')->where('user_id',$user_id)->where('product_id',$id)->
                        where('attribute_id',$value->id)->first();

                        if ($deleted->quantity > $stock){
                            DB::table('carts')->where('id',$deleted->id)->delete();
                            $alert = "yes";

                        }

                    }else{
                        $stock = $item->stock;
                        $deleted = DB::table('carts')->where('user_id',$user_id)->where('product_id',$id)->
                        where('attribute_id',0)->first();

                        if($deleted->quantity > $stock){
                            DB::table('carts')->where('id',$deleted->id)->delete();
                            $alert = "yes";

                        }

                    }
                }else{
                    $removed = "yes";
                }


            }

            if ($alert == "yes"){
                Session::flash('failure', 'One Or More Of The Items Is/Are Not Available In The Requested Quantity. Please Re-add Items To Your Cart!');
                return \redirect()->route('cart');
            }
        }else{
            $session_id = Session::get('session_id');
            $alert = "";
            $cart_products = DB::table('carts')->where(['session_id'=>$session_id])->orderBy('id','desc')->get();

            foreach ($cart_products as $product){
                $id = $product->product_id;
                $item = Product::where('id',$id)->first();
                if ($item){
                    $stock = 0;
                    if($item->stock_status == "yes"){

                        $value = Attribute::where('id',$product->attribute_id)->where('product_id',$id)->first();
                        $stock = $value->stock;
                        $deleted = DB::table('carts')->where('session_id',$session_id)->where('product_id',$id)->
                        where('attribute_id',$value->id)->first();

                        if ($deleted->quantity > $stock){
                            DB::table('carts')->where('id',$deleted->id)->delete();
                            $alert = "yes";

                        }

                    }else{
                        $stock = $item->stock;
                        $deleted = DB::table('carts')->where('session_id',$session_id)->where('product_id',$id)->
                        where('attribute_id',0)->first();

                        if($deleted->quantity > $stock){
                            DB::table('carts')->where('id',$deleted->id)->delete();
                            $alert = "yes";

                        }

                    }
                }else{
                    $removed = "yes";
                }


            }

            if ($alert == "yes"){
                Session::flash('failure', 'One Or More Of The Items Is/Are Not Available In The Requested Quantity. Please Re-add Items To Your Cart!');
                return \redirect()->route('cart');
            }

        }


        return view('frontend.pages.order-review')->with(compact('billingDetails','shippingDetails','cart_products'));

    }






    public function applyCoupon(Request $request){
        $data = $request->all();
        $couponCount = Coupon::where('coupon_code','=',$data['coupon_code'])->count();
        if($couponCount == 0){
            Session::flash('failure','This coupon does not exist!');
            return redirect()->back();
        }
        else{
            //if coupon is inactive
            $couponDetails = Coupon::where('coupon_code','=',$data['coupon_code'])->first();
            if($couponDetails->status == 0){
                Session::flash('failure','This coupon is not active!');
                return redirect()->back();
            }

            //if coupon is expired
            $expiry_date = $couponDetails->expiry_date;
            $current_date = date('Y-m-d');

            if($expiry_date < $current_date){
                Session::flash('failure','This coupon has expired!, please get a new one');
                return redirect()->back();
            }



            if(Auth::guard('visitor')->check()) {
                $user_id = Auth::guard('visitor')->user()->id;
                //$userDetails = Visitor::where('id',$user_id)->first();
                $userCart = DB::table('carts')->where(['user_id'=>$user_id])->orderBy('id','desc')->get();
            }else{
                $userDetails = null;
                $session_id = Session::get('session_id');
                $userCart = DB::table('carts')->where('session_id',$session_id)->where('session_id','<>',null)->orderBy('id','desc')->get();
            }


            $total_amount =0;
            foreach($userCart as $item){

                $total_amount = $total_amount + ($item->price * $item->quantity);

            }
            //check if amount type is fixed or percentage
            if($couponDetails->amount_type == "Fixed"){
                $couponAmount = $couponDetails->amount;
                $couponRate = null;
            }
            else{
                $couponAmount = $total_amount * ($couponDetails->amount/100);
                $couponRate = $couponDetails->amount;
            }

            //Add Coupon code and amount in Session
            Session::put('CouponAmount',$couponAmount);
            Session::put('CouponCode',$data['coupon_code']);
            Session::put('CouponRate',$couponRate);



           $coupon_amount = Session::get('CouponAmount');
           $coupon_code = Session::get('CouponCode');
            $coupon_rate = Session::get('CouponRate');




            Session::flash('success','Coupon successfully applied, you have discount');
            return redirect()->route('order.review')->with(compact('coupon_amount','coupon_code','coupon_rate'));

        }
    }

    public function forgetCoupon(){
        if(!empty(Session::get('CouponAmount')) && !empty(Session::get('CouponCode'))){
            Session::forget('CouponAmount');
            Session::forget('CouponCode');
            Session::forget('CouponRate');
        }
        Session::flash('success','Coupon Discount Removed');
        return \redirect()->back();

    }


    public function processOrder(){


        $ship = Session::get('shipping');
        $bill = Session::get('billing');

        $shippingDetails = $ship;
        $billingDetails = $bill;




        if(Auth::guard('visitor')->check()){
            $user_id = Auth::guard('visitor')->user()->id;
            $cart_products = DB::table('carts')->where(['user_id'=>$user_id])->orderBy('id','desc')->get();
        }else{
            $session_id = Session::get('session_id');
            $cart_products = DB::table('carts')->where(['session_id'=>$session_id])->orderBy('id','desc')->get();
        }

        //$cart_products = DB::table('carts')->where(['session_id'=>$session_id])->orderBy('id','desc')->get();

        //Find if Items Are Still Available
        $alert = "";
        $status = "";
        $removed = "";
        if(Auth::guard('visitor')->check()){
            $user_id = Auth::guard('visitor')->user()->id;
            $cart_products = DB::table('carts')->where(['user_id'=>$user_id])->orderBy('id','desc')->get();
            foreach ($cart_products as $product){
                $id = $product->product_id;
                $item = Product::where('id',$id)->first();


                if($item){

                    if($item->status == 0 ){


                        DB::table('carts')->where('product_id',$item->id)->where('user_id',$user_id)->delete();
                        $status = "yes";

                    }else{
                        $stock = 0;
                        if($item->stock_status == "yes"){

                            $value = Attribute::where('id',$product->attribute_id)->where('product_id',$id)->first();
                            $stock = $value->stock;
                            $deleted = DB::table('carts')->where('user_id',$user_id)->where('product_id',$id)->
                            where('attribute_id',$value->id)->first();

                            if ($deleted->quantity > $stock){
                                DB::table('carts')->where('id',$deleted->id)->delete();
                                $alert = "yes";

                            }

                        }else{
                            $stock = $item->stock;
                            $deleted = DB::table('carts')->where('user_id',$user_id)->where('product_id',$id)->
                            where('attribute_id',0)->first();

                            if($deleted->quantity > $stock){
                                DB::table('carts')->where('id',$deleted->id)->delete();
                                $alert = "yes";

                            }

                        }

                    }
                }else{
                    $removed = "yes";
                }

            }

        }else{
            $session_id = Session::get('session_id');


            $cart_products = DB::table('carts')->where(['session_id'=>$session_id])->orderBy('id','desc')->get();

            foreach ($cart_products as $product){
                $id = $product->product_id;
                $item = Product::where('id',$id)->first();


                if($item){

                    if($item->status == 0 ){


                        DB::table('carts')->where('product_id',$item->id)->where('session_id',$session_id)->delete();
                        $status = "yes";

                    }else{
                        $stock = 0;
                        if($item->stock_status == "yes"){

                            $value = Attribute::where('id',$product->attribute_id)->where('product_id',$id)->first();
                            $stock = $value->stock;
                            $deleted = DB::table('carts')->where('session_id',$session_id)->where('product_id',$id)->
                            where('attribute_id',$value->id)->first();

                            if ($deleted->quantity > $stock){
                                DB::table('carts')->where('id',$deleted->id)->delete();
                                $alert = "yes";

                            }

                        }else{
                            $stock = $item->stock;
                            $deleted = DB::table('carts')->where('session_id',$session_id)->where('product_id',$id)->
                            where('attribute_id',0)->first();

                            if($deleted->quantity > $stock){
                                DB::table('carts')->where('id',$deleted->id)->delete();
                                $alert = "yes";

                            }

                        }

                    }
                }else{
                    $removed = "yes";
                }

            }

        }



        //Find out if Item is Enabled


        if($removed == "yes"){
            Session::flash('failure', 'One Or Some Of The Items In Your Cart Has / Have Removed!');
            return \redirect()->route('cart');
        }

        if($status == "yes"){
            Session::flash('failure', 'One Or Some Of The Items In Your Cart Has / Have Been Disabled Or Removed!');
            return \redirect()->route('cart');
        }



        if ($alert == "yes"){
            Session::flash('failure', 'One Or More Of The Items Is/Are Not Available In The Requested Quantity. Please Re-add Items To Your Cart!');
            return \redirect()->route('cart');
        }else{

            $total_amount = 0;
            foreach ($cart_products as $product){

                $total_amount = $total_amount + ($product->price * $product->quantity);
            }

            //Add Coupon
            if(!empty(Session::get('CouponAmount')) && !empty(Session::get('CouponCode'))){
                $coupon_code = Session::get('CouponCode');
                $coupon_amount = Session::get('CouponAmount');
                $coupon_rate = Session::get('CouponRate');

            }else{
                $coupon_code = '';
                $coupon_amount = null;
                $coupon_rate = null;
            }



            $grandTotal =  $total_amount - $coupon_amount;




            $order = new Order;
            $order->email = $shippingDetails[9];
            if(Auth::guard('visitor')->check()){
                $user_id = Auth::guard('visitor')->user()->id;
                $order->user_id = $user_id;
                $order->session_id = null;
            }else{
                $order->user_id = null;
                $order->session_id = $session_id;
            }


            $order->name = $shippingDetails[2].' '.$shippingDetails[3];
            $order->order_status = "New";
            $order->total_amount = $total_amount;
            $order->coupon_code = $coupon_code;
            $order->coupon_amount = $coupon_amount;
            $order->coupon_rate = $coupon_rate;
            $order->grand_total = $grandTotal;
            $order->save();


            $order_id = DB::getPdo()->lastInsertId();
            //Shipping and Delivery Here

            $billingAddress = new BillingAddress;
            $billingAddress->user_id = $billingDetails[1];
            $billingAddress->order_id = $order_id;
            $billingAddress->session_id = $billingDetails[0];
            $billingAddress->first_name = $billingDetails[2];
            $billingAddress->last_name = $billingDetails[3];
            $billingAddress->address = $billingDetails[4];
            $billingAddress->town = $billingDetails[5];
            $billingAddress->state = $billingDetails[6];
            $billingAddress->country = $billingDetails[7];
            $billingAddress->postcode = $billingDetails[8];
            $billingAddress->email = $billingDetails[9];
            $billingAddress->phone_number = $billingDetails[10];
            $billingAddress->save();

            //dd($billingAddress);


            $shippingAddress = new DeliveryAddress;
            $shippingAddress->user_id = $shippingDetails[1];
            $shippingAddress->order_id = $order_id;
            $shippingAddress->session_id = $shippingDetails[0];
            $shippingAddress->first_name = $shippingDetails[2];
            $shippingAddress->last_name = $shippingDetails[3];
            $shippingAddress->address = $shippingDetails[4];
            $shippingAddress->town = $shippingDetails[5];
            $shippingAddress->state = $shippingDetails[6];
            $shippingAddress->country = $shippingDetails[7];
            $shippingAddress->postcode = $shippingDetails[8];
            $shippingAddress->email = $shippingDetails[9];
            $shippingAddress->phone_number = $shippingDetails[10];
            $shippingAddress->note = $shippingDetails[11];
            $shippingAddress->save();




            if(Auth::guard('visitor')->check()){
                $user_id = Auth::guard('visitor')->user()->id;
                $cartProducts = DB::table('carts')->where(['user_id' => $user_id])->get();
            }else{
                $cartProducts = DB::table('carts')->where(['session_id' => $session_id])->get();
            }

            foreach($cartProducts as $pro){
                $cartPro = new OrdersProduct;
                $cartPro->attribute_id = $pro->attribute_id;
                if(Auth::guard('visitor')->check()){
                    $user_id = Auth::guard('visitor')->user()->id;
                    $cartPro->user_id = $user_id;
                    $cartPro->session_id = null;
                }else{
                    $cartPro->user_id = null;
                    $cartPro->session_id = $session_id;
                }


                $cartPro->order_id = $order_id;
                $cartPro->product_code = $pro->product_code;
                $cartPro->product_name = $pro->product_name;
                $cartPro->product_qty = $pro->quantity;
                //$product_price =   \App\Product::getProductPrice($pro->product_id,$pro->size);
                $cartPro->product_price = $pro->price;
                $cartPro->product_id = $pro->product_id;
                $cartPro->save();
                //$newStock = 0;
            }



            //Update Stock
            $orders_product = OrdersProduct::where('order_id',$order_id)->get();

            foreach ($orders_product as  $item){


                $prod_pro = Product::where('id',$item->product_id)->first();


                if($prod_pro->stock_status == "yes"){

                    //echo "$item->product_qty || $item->attribute_id<br>";
                    $prod = Attribute::where('id',$item->attribute_id)->first();
                    $newStock = $prod->stock - $item->product_qty;
                    Attribute::where('id',$item->attribute_id)->update(['stock'=>$newStock]);

                }else if($prod_pro->stock_status == "no"){

                    $newStock = $prod_pro->stock - $item->product_qty;
                    Product::where('id',$item->product_id)->update(['stock'=>$newStock]);

                }


            }



            //Delete From Cart
            if(Auth::guard('visitor')->check()){
                $user_id = Auth::guard('visitor')->user()->id;
                DB::table('carts')->where('user_id',$user_id)->delete();
            }else{
                DB::table('carts')->where('session_id',$session_id)->delete();

            }

            if(!empty(Session::get('CouponAmount')) && !empty(Session::get('CouponCode'))){
                Session::forget('CouponAmount');
                Session::forget('CouponCode');
                Session::forget('CouponRate');
            }


            //Trigger Mails


            $orderDetails = Order::with('orders')->where('id',$order_id)->first();
            //$user_id = $orderDetails->session_id;




            //Send Email;
           dispatch(new sendUserInvoice($orderDetails));
           dispatch(new sendAdmInvoice($orderDetails,$billingAddress));



            Session::put('order_id',$order_id);
            Session::put('grandTotal',$grandTotal);

            Session::flash('success', 'Order Successful!');
            return \redirect()->route('thank.you');


        }







    }

    public function thankYou(){
        $order_id = Session::get('order_id');
        $grandTotal = Session::get('grandTotal');

        return view('frontend.pages.process-order')->with(compact('order_id','grandTotal'));
    }


    public function privacy(){
        return view('frontend.pages.privacy');
    }


    public function tester(){
        $orderDetails = Order::where('id',13)->first();
        return view('backend.tester')->with(compact('orderDetails'));
    }


}
