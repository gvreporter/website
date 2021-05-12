<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

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
            return redirect()->route('home');
        }

        return back()
            ->withErrors(['password' => 'Password errata'])
            ->withInput(['username' => $request->get('username')]);
    }
}
