<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    /**
     * Render the new post page
     *
     * @return \Illuminate\Support\Facades\Response
    */
    public function create()
    {
        return view('pages.admin.posts.new');
    }

    /**
     * Store the new post
     *
     * @return \Illuminate\Support\Facades\Response
    */
    public function store(StorePostRequest $request)
    {
        $post = new Post;
        $post->title = $request->get('name');
        $post->cover_url = $request->get('cover');
        $post->slug = Str::slug($request->get('name'), '-', 'it');
        $post->user_id = Auth::id();
        $post->save();

        $content = $request->get('article');
        Storage::disk('posts')->put($post->id . '.md', $content);

        return redirect()->route('dash');
    }

    /**
     * Render the post image
     *
     * @return \Illuminate\Support\Facades\Response
    */
    public function showImage(string $slug)
    {
        $post = Post::where('slug', $slug)->first();

        if(!$post) return abort(404);

        return $post->generateImage()->response('jpg');
    }
}
