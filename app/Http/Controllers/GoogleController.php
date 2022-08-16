<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback(){
        try {
            $user = Socialite::driver('google')->user();
            $findUser = User::where('google_id',$user->getId())->first();
            if ($findUser) {
                Auth::login($findUser);
                return redirect()->route('home');
            }else{
                $newUser = New User;
                $newUser->username = $user->id;
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->google_id = $user->id;
                $newUser->avatar = $user->avatar;
                $newUser->password = bcrypt('12345678');
                $newUser->save();

                Auth::login($newUser);
                return redirect()->route('home');
            }
        } catch (\Throwable $th) {
            return redirect('auth/google');
        }
    }
}
