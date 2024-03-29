<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Charts\MonthlyUsers;
use App\Order;
use App\Product;
use App\Review;
use App\Subscriber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Session;


class AdminController extends Controller
{
    //
    public function dashboard(){
        $users = User::all();
        $count = $users->count();

        $admins = User::where('id','<>',1)->orderBy('id','desc')->take(5)->get();

        $orders = Order::with('orders')->orderBy('id','DESC')->take(5)->get();


        $current_month_products = Product::whereMonth('created_at',Carbon::now()->month)->count();
        $last_month_products = Product::whereMonth('created_at',Carbon::now()->subMonth(1))->count();
        $last_two_month_products = Product::whereMonth('created_at',Carbon::now()->subMonth(2))->count();
        $last_three_month_products = Product::whereMonth('created_at',Carbon::now()->subMonth(3))->count();
        $last_four_month_products = Product::whereMonth('created_at',Carbon::now()->subMonth(4))->count();
        $last_five_month_products = Product::whereMonth('created_at',Carbon::now()->subMonth(5))->count();

        $product_array = array("month-1"=>$current_month_products,'month-2'=>$last_month_products,'month-3'=>$last_two_month_products,
        'month-4'=>$last_three_month_products, 'month-5'=>$last_four_month_products, 'month-6'=>$last_five_month_products);



        $current_month_subscribers = Subscriber::whereMonth('created_at',Carbon::now()->month)->where('status',1)->count();
        $last_month_subscribers = Subscriber::whereMonth('created_at',Carbon::now()->subMonth(1))->where('status',1)->count();
        $last_two_month_subscribers = Subscriber::whereMonth('created_at',Carbon::now()->subMonth(2))->where('status',1)->count();
        $last_three_month_subscribers = Subscriber::whereMonth('created_at',Carbon::now()->subMonth(3))->where('status',1)->count();
        $last_four_month_subscribers = Subscriber::whereMonth('created_at',Carbon::now()->subMonth(4))->where('status',1)->count();
        $last_five_month_subscribers = Subscriber::whereMonth('created_at',Carbon::now()->subMonth(5))->where('status',1)->count();

        $subscriber_array = array("month-1"=>$current_month_subscribers,'month-2'=>$last_month_subscribers,'month-3'=>$last_two_month_subscribers,
        'month-4'=>$last_three_month_subscribers, 'month-5'=>$last_four_month_subscribers, 'month-6'=>$last_five_month_subscribers);



        $current_month_orders = Order::whereMonth('created_at',Carbon::now()->month)->count();
        $last_month_orders = Order::whereMonth('created_at',Carbon::now()->subMonth(1))->count();
        $last_two_month_orders = Order::whereMonth('created_at',Carbon::now()->subMonth(2))->count();
        $last_three_month_orders = Order::whereMonth('created_at',Carbon::now()->subMonth(3))->count();
        $last_four_month_orders = Order::whereMonth('created_at',Carbon::now()->subMonth(4))->count();
        $last_five_month_orders = Order::whereMonth('created_at',Carbon::now()->subMonth(5))->count();

        $order_array = array("month-1"=>$current_month_orders,'month-2'=>$last_month_orders,'month-3'=>$last_two_month_orders,
        'month-4'=>$last_three_month_orders, 'month-5'=>$last_four_month_orders, 'month-6'=>$last_five_month_orders);


        $current_month_sales = Order::whereMonth('created_at',Carbon::now()->month)
        ->where(function($q){$q->where('order_status','Shipped')->orWhere('order_status','Delivered');})->sum('grand_total');

        $last_month_sales = Order::whereMonth('created_at',Carbon::now()->subMonth(1))
        ->where(function($q){$q->where('order_status','Shipped')->orWhere('order_status','Delivered');})->sum('grand_total');

        $last_two_month_sales = Order::whereMonth('created_at',Carbon::now()->subMonth(2))
        ->where(function($q){$q->where('order_status','Shipped')->orWhere('order_status','Delivered');})->sum('grand_total');

        $last_three_month_sales = Order::whereMonth('created_at',Carbon::now()->subMonth(3))
        ->where(function($q){$q->where('order_status','Shipped')->orWhere('order_status','Delivered');})->sum('grand_total');

        $last_four_month_sales = Order::whereMonth('created_at',Carbon::now()->subMonth(4))
        ->where(function($q){$q->where('order_status','Shipped')->orWhere('order_status','Delivered');})->sum('grand_total');

        $last_five_month_sales = Order::whereMonth('created_at',Carbon::now()->subMonth(5))
        ->where(function($q){$q->where('order_status','Shipped')->orWhere('order_status','Delivered');})->sum('grand_total');

        $sale_array = array("month-1"=>$current_month_sales,'month-2'=>$last_month_sales,'month-3'=>$last_two_month_sales,
        'month-4'=>$last_three_month_sales, 'month-5'=>$last_four_month_sales, 'month-6'=>$last_five_month_sales);



        $categories_count = Category::all()->count();
        $products_count = Product::all()->count();
        $brands_count = Brand::all()->count();

        $products = Product::orderBy('id','desc')->take(5)->get();
        $brands = Brand::orderBy('id','desc')->take(5)->get();
        $categories = Category::with('products')->where('parent_id','<>', 0)->orderBy('id','desc')->take(6)->get();



        return view('backend.dashboard')->with(compact('count','categories_count','products_count','brands_count',
        'products','categories','brands','admins','product_array','subscriber_array','orders','order_array','sale_array'));
    }


    //Super backend to register new user, and registers as a normal user automatically.
    public function registerUser(Request $request){

        if($request->isMethod('post')){


            $this->validation($request);
            $user = new User();


            $user->username = $request->username;
            $user->email = $request->email;
            $user->active = 0;
            $user->password = bcrypt($request->password);
            $user->save();
            $user->roles()->attach(Role::where('name', 'User')->first());
            Session::flash('success',' The user has been successfully created!');
            return redirect()->route('show.users');
        }

        return view('backend.auth.add_user');

    }

    public function validation($request)
    {
        return $this->validate($request ,[
            'username'=> 'required|max:255',
            'email'=> 'required|email|unique:users|max:255',
            'password'=> 'required|max:255|confirmed'
        ]);
    }




    public function showReviews($id){
        $reviews = Review::where('product_id',$id)->orderBy('id','desc')->get();
        $product = Product::where('id',$id)->first();
        return view('backend.reviews.index')->with(compact('reviews','product'));
    }

    public function editReview(Request $request, $id){
        $data = $request->all();
        $review = Review::where('id',$id)->first();
        if (empty($data['approve'])) {
            $review->approve = 0;
        } else {
            $review->approve = 1;
        }

        $user_id = $review->user_id;

        $review->user_id = $user_id;
        $review->product_id = $data['product_id'];
        $review->body = $data['body'];
        $review->title = $data['title'];
        $review->rating = $data['rating'];

        $review->save();
        Session::flash('success',' Review Details Successfully Uploaded!');
        return redirect()->back();
    }


    public function deleteReview($id){
        $review = Review::where('id',$id)->first();
        $review->delete();
        Session::flash('deleted',' Review Deleted Successfully!');
        return redirect()->back();
    }


    //Show all the users apart from the owner of the website
    public function showUsers(){

        $users = User::where('id','<>',1)->get();
        return view('backend.auth.show_users')->withUsers($users);
    }



    //Shows a particular user
    public function showUser($id){
        $users = User::find($id);
        return view('backend.auth.show')->withUser($users);

    }

    //Edit user details
    public function editUser(Request $request){

        $id = $request->id;
        $status = 0;
        $this->validate($request, [
            'username'=> 'required|max:255',
            'email'=> 'required|max:255',
        ]);


        if(isset($request->active)){
            if($request->active = 'on'){
                $status = 1;
            }
        }

        $user = User::find($id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->active = $status;



        $user->save();

        Session::flash('success',' User info updated successfully!');
        return redirect()->route('show.users');
    }


    //Delete a user
    public function destroy($id)
    {

        User::find($id)->delete($id);

        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);

    }



    //Assign roles to a new user
    public function assignUser(Request $request){
        $user = User::where('id', $request['id'])->first();
        $user->roles()->detach();
        if ($request['role_user']) {
            $user->roles()->attach(Role::where('name', 'User')->first());
        }
        if ($request['role_author']) {
            $user->roles()->attach(Role::where('name', 'Author')->first());
        }
        if ($request['role_admin']) {
            $user->roles()->attach(Role::where('name', 'Admin')->first());
        }
        Session::flash('success',' New role(s) assigned to user!');
        return redirect()->back();
    }



    //For logged in users now
    public function showProfile(){

        $id = Auth::user()->id;
        $user = User::find($id);
        return view('backend.auth.show')->withUser($user);
    }



    public function editProfile(Request $request){

        $id = Auth::user()->id;
        $user = User::find($id);


        if($request->isMethod('POST')){
            $user->username = $request->username;
            $user->email = $request->email;
            $filename = '';
            if($user->image == null){
                if($request->hasFile('image')) {
                    $img_temp = $request->file('image');
                    if ($img_temp->isValid()) {

                        $extension = $img_temp->getClientOriginalExtension();
                        $filename = 'alvins' . rand(111, 9999) . '.' . $extension;

                        $image_path = 'images/backend/users/' . $filename;

                        //Resize Images

                        Image::make($img_temp)->resize(300, 300)->save($image_path);
                    }

                }
            }else{
                $old_image = $user->image;

                if($request->hasFile('image')) {
                    $img_temp = $request->file('image');
                    if ($img_temp->isValid()) {

                        $extension = $img_temp->getClientOriginalExtension();
                        $filename = 'alvins' . rand(111, 9999) . '.' . $extension;

                        $image_path = 'images/backend/users/' . $filename;

                        //Resize Images

                        Image::make($img_temp)->resize(300, 300)->save($image_path);

                        //Delete
                        $image_src = 'images/backend/users/';


                        //Delete
                        if(file_exists($image_src.$old_image)){
                            unlink($image_src.$old_image);
                        }

                    }

                }else{
                    $filename = $old_image;
                }

            }

            $user->image = $filename;
            $user->save();


            Session::flash('success',' Your details have been changed successfully!');
            return redirect()->route('show.profile');

        }
        return view('backend.auth.edit')->withUser($user);
    }





    public function editPassword(Request $request){

        $id = Auth::user()->id;
        $user = User::find($id);

        if($request->isMethod('post')){
            $this->validate($request, [
                'password'=> 'required|max:255|confirmed'
            ]);

            $user = User::find($id);
            $user->password = bcrypt($request->password);
            $user->save();
            Session::flash('success',' Password successfully updated!');
            return redirect()->route('show.profile');
        }



        return view('backend.auth.password')->withUser($user);
    }


    public function subscribers(){
        $subscribers = Subscriber::paginate(30);
        return view('backend.subscribers.index')->with(compact('subscribers'));
    }

    public function deactivateSubscriber($id=null){

        $subscriber = Subscriber::find($id);
        $subscriber->status = 0;
        $subscriber->save();
        Session::flash('success',' Deactivation Successful!');
        return redirect()->back();

    }


    public function activateSubscriber($id=null){
        $subscriber = Subscriber::find($id);
        $subscriber->status = 1;
        $subscriber->save();
        Session::flash('success',' Activation Successful!');
        return redirect()->back();

    }


    public function deleteSubscriber($id=null){
        $subscriber = Subscriber::find($id)->first();
        $subscriber->delete();
        Session::flash('success',' Subscriber Deleted Successful!');
        return redirect()->back();

    }


}
