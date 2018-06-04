<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Socialite;
use App\Models\User;
use App\Models\SocialAccount;

class LoginSocialController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from facebook.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        //return $user->name;
        $existUser = User::where('email',$user->email)->first();
        if($existUser)
        {
            if($existUser->user_role == 0)
                Auth::login($existUser);
            return redirect('/home');
        }
        else
        {
            $email       = $user->email;
            $phone_num   = "";
            $name        = $user->email;
            $password    = "";
            $user_role   = 1;
            $user = User::create(
                [
                "email"          =>$email, 
                "phone"          =>$phone_num, 
                "username"       =>$name,
                "password"       =>$password,  
                "user_role"      =>$user_role,
                ]);
            $type = 0;
            if($provider === "google") $type = 1;
            if($provider === "facebook") $type = 2;
            $social_acount = SocialAccount::create([
                "user_id"   => $user->id,
                "type"      => $type
            ]);
            Auth::login($user);
            return redirect('/home');
        }
    }
}
