<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function create()
    {
        return view('pages.admin.posts.new');
    }

    public function store(StorePostRequest $request)
    {

        return redirect()->route('dash');
    }
}
