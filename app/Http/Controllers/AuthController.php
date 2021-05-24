<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Repositories\UsersRepository;
use Illuminate\Support\Facades\Log;

const ALLOWED_HD = ['studenti.gobettivolta.edu.it', 'gobettivolta.edu.it'];

class AuthController extends Controller
{
    /**
     * @var \App\Repositories\UsersRepository
    */
    protected $users;

    public function __construct(UsersRepository $users) {
        $this->users = $users;
    }


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

    public function oauthRedirect(Request $request)
    {
        // The app will use ?continue=app so when the login will successed it will be redirected
        // to gvreporter://login?code=ABC123
        if($request->get('continue', 'web') === 'app') {
            $request->session()->flash('oauth::continue', 'app');
        }
        return Socialite::driver('google')
            ->with(['hd' => 'gobettivolta.edu.it' ])
            ->redirect();
    }

    public function handleOauth(Request $request)
    {
        $user = $this->users->fromOAuth($request);

        // Check if the user wanted to login with apis
        if($request->session()->get('oauth::continue') == 'app') {
            // Get the user jwt (token) and return that to the app
            $token = auth('api')->login($user);
            return redirect('gvreporter://login?code='.$token);
        } else {
            Auth::login($user);

            return redirect()
                ->route('home')
                ->with('success', 'Bentornato ' . $user->name . "! Hai eseguito l'accesso correttamente");
        }

    }
}
