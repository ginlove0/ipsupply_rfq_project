<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
//        dd($request->email);

        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'status' => 1
        ]))
        {

            return redirect()->route('home');
//            $user = User::where('email', $request->email)->first();
//            if($user -> is_groupa === true)
//            {
//                return redirect()->route('home');
//            }
//            if($user -> is_groupb === true)
//            {
//                return redirect()->route('home');
//            }
//            if($user -> is_groupc === true)
//            {
//                return redirect()->route('home');
//            }
//            return redirect()->route('home');
        }

        return $this->sendFailedLoginResponse($request);
    }

    public function logout () {
        //logout user
        auth()->logout();
        // redirect to homepage
        return redirect(url('/login'));
    }
}
