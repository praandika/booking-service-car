<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Console\View\Components\Alert;


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
                $newUser->username = $user->email;
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->google_id = $user->id;
                $newUser->avatar = $user->avatar;
                $newUser->password = bcrypt('12345678');
                $newUser->access = 'customer';
                $newUser->save();

                Auth::login($newUser);
                return redirect()->route('home');
            }
        } catch (Exception $e) {
            if ($e->getMessage() == "") {
                return redirect('auth/google');
            } else {
                alert()->warning('Email Sudah Terdaftar!','Gunakan akun lain.');
                return redirect()->route('login');
            }
        }
    }
}
