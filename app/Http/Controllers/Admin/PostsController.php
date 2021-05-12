<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function create()
    {
        return view('pages.admin.posts.new');
    }

    public function store(StorePostRequest $request)
    {
        $post = new Post;
        $post->title = $request->get('name');
        $post->slug = Str::slug($request->get('name'), '-', 'it');
        $post->user_id = Auth::id();
        $post->save();

        $content = $request->get('article');
        Storage::disk('posts')->put($post->id . '.md', $content);

        return redirect()->route('dash');
    }
}
