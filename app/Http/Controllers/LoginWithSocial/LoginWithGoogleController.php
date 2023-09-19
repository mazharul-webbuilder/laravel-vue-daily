<?php

namespace App\Http\Controllers\LoginWithSocial;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginWithGoogleController extends Controller
{
    public function loginView()
    {
        return view('social-login.google.login-view');
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if($finduser){

                Auth::login($finduser);

                return redirect()->intended('dashboard');

            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('password')
                ]);

                Auth::login($newUser);

//                return redirect()->intended('dashboard');
                dd(Auth::user());
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}

/*Follow this tutorial if any trouble*/
//https://techsolutionstuff.com/post/laravel-10-socialite-login-with-google-account
