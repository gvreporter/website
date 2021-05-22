<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteAccountRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Repositories\UsersRepository;

class SettingsController extends Controller
{

    /**
     * @var \App\Repositories\UsersRepository
    */
    protected $users;

    public function __construct(UsersRepository $users) {
        $this->users = $users;
    }


    public function index()
    {
        return view('pages.settings.index', [
            'user' => Auth::user(),
        ]);
    }

    public function delete()
    {
        return view('pages.settings.confirm');
    }

    public function confirmDelete(DeleteAccountRequest $request)
    {
        $realName = Str::lower(Auth::user()->name);
        $userName = Str::lower($request->get('name', ''));

        if($userName !== $realName) {
            return back()->withErrors(['name' => 'Il nome non corrisponde']);
        }

        $this->users->delete(Auth::id());
        return redirect()->route('home')->with('success', 'Il tuo account è stato eliminato.');
    }
}
