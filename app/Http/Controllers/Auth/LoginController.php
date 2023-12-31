<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $usercheck = User::where('email', '=', $user->email)->first();
        if(!$usercheck){
            $data = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'provider_id' => $user->id,
                'avatar' => $user->avatar,
            ]);
            Auth::login($data);
            return redirect()->route('home');
        }else{
            Auth::login($usercheck);
            return redirect()->route('home');
        }
    }

    // Facebook Login 
    public function redirectToFacebook(){
        return Socialite::driver('facebook')->redirect();
    }
    // Facebook Callback 
    public function handleFacebookCallback(){
        $user = Socialite::driver('facebook')->user();
        dd($user);
    }


    // Github Login 
    public function redirectToGithub(){
        return Socialite::driver('github')->redirect();
    }
    // Github Callback 
    public function handleGithubCallback(){
        $user = Socialite::driver('github')->user();

        $usercheck = User::where('email', '=', $user->email)->first();
        if(!$usercheck){
            $data = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'provider_id' => $user->id,
                'avatar' => $user->avatar,
            ]);
            Auth::login($data);
            return redirect()->route('home');
        }else{
            Auth::login($usercheck);
            return redirect()->route('home');
        }
    }
}
