<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Repositories\PostsRepository;

class HomeController extends Controller
{
    /**
     * @var \App\Repositories\PostsRepository
    */
    protected $posts;

    public function __construct(PostsRepository $posts) {
        $this->posts = $posts;
    }

    /**
     *  Home page
     *
     * @return Illuminate\Support\Facades\Response
    */
    public function home()
    {
        $posts = $this->posts->latest();

        return view('pages.home', [
            'lastPost' => $posts[0],
            'posts' => $posts->slice(1),
        ]);
    }
}
