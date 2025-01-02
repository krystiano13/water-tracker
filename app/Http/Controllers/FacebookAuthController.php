<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        $facebookUser = Socialite::driver('facebook')->user();

        $user = User::where('email', $facebookUser->email)->first();

        if($user)
        {
            Auth::login($user);
            return redirect('/dashboard');
        }
        else {
            $newUser = User::create([
                'name' => $facebookUser->name,
                'email' => $facebookUser->email,
                'facebook_id' => $facebookUser->id,
            ]);

            Auth::login($newUser);
            return redirect('/dashboard');
        }
    }
}
