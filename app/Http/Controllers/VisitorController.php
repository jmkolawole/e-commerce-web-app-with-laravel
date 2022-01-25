<?php

namespace App\Http\Controllers;

use App\BillingAddress;
use App\Country;
use App\DeliveryAddress;
use App\Order;
use App\Subscriber;
use App\Visitor;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class VisitorController extends Controller
{
    //


    public function register(Request $request){

        if($request->isMethod('post')){
            //dd($request);

            if(!empty($request->first_name) && !empty($request->last_name) && !empty($request->email)){
                if($request->password != $request->password_confirmation){
                    Session::flash('failure', 'Passwords Do Not Match. Please try again!');
                }else{
                    $user = new Visitor;
                    $token = Str::random(32);
                    $user->first_name = $request->first_name;
                    $user->last_name = $request->last_name;
                    $user->email = $request->email;
                    $user->active = 0;
                    $user->password = bcrypt($request->password);
                    $user->save();
                    DB::table('verify_visitors')->insert(['email' => $user->email, 'token' => $token, 'created_at' => new Carbon]);

                    Mail::to($user->email)->send(new \App\Mail\Visitor($user, $token));

                    if($request->newsletter == "on"){
                        $subscriber_count = Subscriber::where('email',$user->email)->count();
                        if($subscriber_count > 0){

                            Session::flash('success', 'Subscriber Already Exist. You can go ahead with the registration!');
                            return back();
                        }else{
                            $token = Str::random(32);
                            $subscriber = new Subscriber;
                            $subscriber->email = $user->email;
                            $subscriber->status = 0;
                            $subscriber->save();
                            DB::table('verify_subscribers')->insert(['email' => $subscriber->email, 'token' => $token, 'created_at' => new Carbon]);

                            //trigger mail
                            Mail::to($subscriber->email)->send(new \App\Mail\Subscriber($subscriber, $token));
                            echo 'saved';
                        }
                    }

                    //Trigger Mail.
                    Session::flash('success', 'Registration Successful. Please Check Your Mailbox, Verify Your Account And Complete Your Registration!');
                    return redirect()->route('home');
                }

            }else{
                Session::flash('failure', 'Please Fill Out All Fields!');
                return back();
            }

        }
        return view('frontend.auth.register');
    }



    public function verifyUser($email,$token){
        $user = DB::table('verify_visitors')->where('email','=',$email)->where('token','=',$token)->first();
        $verified_user = Visitor::where('email','=',$user->email)->first();
        if(!$verified_user){
            Session::flash('failure', 'This User Does Not Exist In Our Records!');
        }
        else{
            $verified_user->active = 1;
            $verified_user->update();
            DB::table('verify_visitors')->where('email', $verified_user->email)->delete();
            Session::flash('success', 'Email Verified Successfully!');
            return redirect()->route('home');
        }
    }



    public function forgotPassword(Request $request){
         if($request->isMethod('post')){

             $user = Visitor::where('email','=',$request->email)->first();



             if($user){
                 $password_broker = app(PasswordBroker::class);
                 //create reset password token
                 $token = $password_broker->createToken($user);
                 $code = $token;
                 $this->sendEmail($user,$code);
                 DB::table('visitors_resets')->insert(['email' => $user->email, 'token' => $token, 'created_at' => new Carbon]);

                 return redirect()->back()->with([
                     'success' => 'A Reset Link Has Been Sent To Your Email'
                 ]);

             }else{
                 Session::flash('failure', 'This User Does Not Exist In Our Records!');
             }
         }
        return view('frontend.auth.forgot');
    }




    private function sendEmail($user,$code){
        Mail::send('emails.visitors_reset', [
            'user' => $user,
            'code' => $code
        ], function ($message) use ($user){
            $message->to($user->email);
            $message->from('support@alvinsmakeup.com');
            $message->subject("(alvinsmakeup.com) Hello $user->first_name, reset your password");
        });
    }

    public function passwordResetForm($token){
        $tokenData = DB::table('visitors_resets')
            ->where('token', $token)->first();


        return view('frontend.auth.reset')->with(compact('tokenData'));
    }

    public function reset(Request $request){


        $email = $request->email;
        $password = $request->password;
        $token_data = $request->token;
        $password_confirmation = $request->password_confirmation;

        if($password == $password_confirmation){

            $token = DB::table('visitors_resets')->where('email','=',$email)->where('token','=',$token_data)->first();

           // dd($token);

            $user = Visitor::where('email','=',$token->email)->first();
            if(!$user){
                Session::flash('failure', 'This User Does Not Exist In Our Records!');

            }else{
                $user->password = bcrypt($password);
                $user->update();
                Auth::guard('visitor')->login($user);
                DB::table('visitors_resets')->where('email', $user->email)->delete();
                Session::flash('success', 'Login Successful!');
                return redirect()->route('home');

            }
        }else
        {
            return redirect()->back();
        }


    }



    public function validation($request)
    {
        return $this->validate($request ,[
            'first_name'=> 'required|max:255',
            'last_name'=> 'required|max:255',
            'email'=> 'required|email|unique:users|max:255',
            'password'=> 'required|max:255'
        ]);
    }

    public function showLoginForm(){
        if(!Auth::guard('visitor')->check()) {
            return view('frontend.auth.login');
        }else{

            Session::flash('failure', 'You Are Already Logged In. You Have To Log Out First!');
            return redirect()->route('home');
        }
    }

    public function login(Request $request){


        if(!Auth::guard('visitor')->check()) {
            //dd($request);
            $this->validate($request, [
                'email' => 'required|email|max:255',
                'password' => 'required|max:255'
            ]);

            if (Auth::guard('visitor')->attempt(['email' => $request['email'], 'password' => $request['password']])) {
                Session::flash('success', 'Login Successful!');
                return redirect()->route('home');
            }

        }else{

            Session::flash('failure', 'You Are Already Logged In. You Have To Log Out First!');
            return redirect()->route('home');
        }
    }


    public function account(Request $request){


        if(Auth::guard('visitor')->check()){
            $user_id = Auth::guard('visitor')->user()->id;
            $user = Visitor::where('id',$user_id)->first();
            $orders = Order::with('orders')->where('user_id',$user_id)->orderBy('id','desc')->paginate(15);
            $countries = Country::get();

        }else{
            return redirect()->route('home');
        }

        if($request->isMethod('post')){

            $firstname = $request->first_name;
            $last_name = $request->last_name;
            $email = $request->email;
            $phone = $request->phone;
            $state = $request->state;
            $city = $request->city;
            $pincode = $request->pincode;
            $address = $request->address;
            $country = $request->country;
            Visitor::where('id',$user_id)->update(['first_name'=>$firstname,'last_name'=>$last_name,'email'=>$email,
                'phone'=>$phone,'state'=>$state,'town'=>$city,'country'=>$country,'pincode'=>$pincode,'address'=>$address]);
            Session::flash('success', 'Account Updated Successfully!');
            return back();

        }

        return view('frontend.auth.account')->with(compact('user','orders','countries'));
    }

    public function changePassword(Request $request){

        if(Auth::guard('visitor')->check()){

            $user_id = Auth::guard('visitor')->user()->id;
            $user = Visitor::where('id',$user_id)->first();
            $check_password = Hash::check($request->current_password,$user->password);
            if($check_password){
                $password = $request->password;
                $password_confirmation = $request->password_confirmation;

                if($password == $password_confirmation){

                    $user->password = bcrypt($password);
                    $user->update();
                    Session::flash('success', 'Password Changed Successfully!');
                    return redirect()->back();
                }else{

                    Session::flash('failure', 'Passwords Do Not Match!');
                    return redirect()->back();
                }

            }else{

                Session::flash('failure', 'The Password Does Not Exist!');
                return redirect()->back();
            }

        }
    }

    public function viewOrder($id){

        if(Auth::guard('visitor')->check()){
            $user_id = Auth::guard('visitor')->user()->id;
            //$user = Visitor::where('id',$user_id)->first();
            $order = Order::with('orders')->where('id',$id)->where('user_id',$user_id)->first();

        }

        $billingDetails = BillingAddress::where('order_id',$order->id)->first();
        $shippingDetails = DeliveryAddress::where('order_id',$order->id)->first();


        return view('frontend.auth.view-order')->with(compact('order','billingDetails','shippingDetails'));
    }


    public function getLogout( Request $request)
    {
        //dd($request);
        //Auth::logout();
        //Session::flash('success',' You have been logged out!');
        if(Auth::guard('visitor')->check()) {
            Auth::guard('visitor')->logout();
             $request->session()->forget('session_id');
             //$request->session()->regenerate();
            Session::flash('success', 'Logged Out Successfully!');
            return redirect()->route('login.user');
        }else{
            Session::flash('failure', 'You Are Logged Out. You Have To Log In First!');
            return redirect()->route('home');
        }
    }
}
