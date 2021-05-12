<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::limit(20)->get();

        return view('pages.posts.list', [
            'posts' => $posts
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)->first();

        if(!$post) return abort(404);

        $post->views++;
        $post->save();

        return view('pages.posts.show', [
            'post' => $post
        ]);
    }
}
