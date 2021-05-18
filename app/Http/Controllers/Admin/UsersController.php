<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUserRequest;
use App\Repositories\UsersRepository;

class UsersController extends Controller
{
    /**
     * @var \App\Repositories\UsersRepository
    */
    protected $users;

    public function __construct(UsersRepository $users) {
        $this->users = $users;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->users->all();
        return view('pages.admin.users.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.users.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->users->store(
            $request->get('name'),
            $request->get('username'),
            $request->get('password'),
            $request->get('role', 'user'),
            $request->get('googleid'),
            $request->get('profilepic')
        );
        return redirect()->route('users')->with('users_store', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $user = $this->users->find($id);
        if(!$user) return abort(404);
        return view('pages.admin.users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUserRequest $request, int $id)
    {
        $user = $this->users->find($id);
        $this->users->update(
            $user,
            $request->get('name', $user->name),
            $request->get('username', $user->username),
            $request->get('role', $user->role),
            $request->get('googleid', $user->google_id),
            $request->get('profilepic', $user->profile_pic_url)
        );
        return redirect()->route('users')->with('users_edit', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->users->delete($id);
        return redirect()->route('users')->with('users_delete', 'success');
    }
}
