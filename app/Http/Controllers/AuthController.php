<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use function App\Helpers\name_case_string;

const ALLOWED_HD = ['studenti.gobettivolta.edu.it', 'gobettivolta.edu.it'];

class AuthController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function login()
    {
        return view('pages.login');
    }

    public function doLogin(LoginRequest $request)
    {
        $credentials = $request->only(['username', 'password']);
        if(Auth::attempt($credentials)) {
            $user = Auth::user();
            if($user->role === 'user') {
                return redirect()
                    ->route('home')
                    ->with('success', 'Bentornato ' . $user->name . "! Hai eseguito l'accesso correttamente");
            }

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

    public function handleOauth(Request $request)
    {
        if(!$request->get('hd') || !in_array($request->get('hd'), ALLOWED_HD)) return abort(401);

        $guser = Socialite::driver('google')->user();

        $name = name_case_string($guser->getName());
        $username = $guser->getNickname() ?? Str::slug($name);

        $user = User::firstOrCreate([
            'profile_pic_url' => $guser->getAvatar(),
            'google_id' => $guser->getId(),
            'name' => $name,
            'username' => $username,
            'password' => 'GOOGLE-OAUTH', // Non hashed password to know that the user logged with a Google Account
            'role' => 'user',
        ]);

        Auth::login($user);

        return redirect()
            ->route('home')
            ->with('success', 'Bentornato ' . $name . "! Hai eseguito l'accesso correttamente");
    }
}
