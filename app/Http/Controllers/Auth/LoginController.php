<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;

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

    // Google Login 
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }
    // Google Callback 
    public function handleGoogleCallback(){
        $user = Socialite::driver('google')->user();
        dd($user);
    }


    // Github Login 
    public function redirectToGithub(){
        return Socialite::driver('github')->redirect();
    }
    // Github Callback 
    public function handleGithubCallback(){
        $user = Socialite::driver('github')->user();
    }
}