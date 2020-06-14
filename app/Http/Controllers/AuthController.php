<?php

namespace App\Http\Controllers;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
class AuthController extends Controller
{


    public function signIn(Request $request){

        if($request->isMethod('post')){

            $this->validate($request,[
                'email' => 'required|email|max:255',
                'password' => 'required|max:255'
            ]);

            if (Auth::attempt(['email' => $request['email'], 'password' => $request['password'],'active' => 1])) {
                Session::flash('success',' You have been logged in!');
                return redirect()->route('dashboard');
            }
            return redirect()->back();
        }

        return view('backend.auth.login');
    }


    public function getLogout()
    {
        Auth::logout();
        Session::flash('success',' You have been logged out!');
        return redirect()->route('login.page');
    }

}
