<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        return view('pages.login');
    }

    public function doLogin(LoginRequest $request)
    {
        $credentials = $request->only(['username', 'password']);
        if(Auth::attempt($credentials)) {
            return redirect('/admin');
        }

        return back()
            ->withErrors(['password' => 'Password errata'])
            ->withInput(['username' => $request->get('username')]);
    }

    public function oauthRedirect()
    {
        return Socialite::driver('google')
            ->with(['hd' => 'gobettivolta.edu.it' ])
            ->redirect();
    }

    public function handleOauth()
    {
        $guser = Socialite::driver('google')->user();

        $username = $guser->getNickname() ?? Str::slug($guser->getName());

        $user = User::firstOrCreate([
            'google_id' => $guser->getId(),
            'name' => $guser->getName(),
            'username' => $username,
            'password' => 'GOOGLE-OAUTH', // Non hashed password to know that the user logged with a Google Account
            'role' => 'user'
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }
}
