<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';


    public function passwordResetForm($token){
        $tokenData = DB::table('password_resets')
            ->where('token', $token)->first();

        return view('backend.auth.reset_password')->with(compact('tokenData'));
    }

    public function reset(Request $request){

        $email = $request->email;
        $password = $request->password;
        $token_data = $request->token;
        $password_confirmation = $request->password_confirmation;

        if($password == $password_confirmation){

            $token = DB::table('password_resets')->where('email','=',$email)->where('token','=',$token_data)->first();


            $user = User::where('email','=',$token->email)->first();
            if(!$user){

            }else{
                $user->password = bcrypt($password);
                $user->update();
                Auth::login($user);
                DB::table('password_resets')->where('email', $user->email)->delete();
                return redirect()->route('dashboard');

            }
        }else
        {
            return redirect()->back();
        }


    }



}
