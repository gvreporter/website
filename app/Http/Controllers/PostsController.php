<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Repositories\PostsRepository;

class PostsController extends Controller
{

    /**
     * @var \App\Repositories\PostsRepository
    */
    protected $posts;

    public function __construct(PostsRepository $posts) {
        $this->posts = $posts;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->posts->latest();

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
        $post = $this->posts->findBySlug($slug, true);

        return view('pages.posts.show', [
            'post' => $post
        ]);
    }
}
