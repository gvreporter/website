<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Repositories\PostsRepository;
use App\Repositories\QuotesRepository;

class HomeController extends Controller
{
    /**
     * @var \App\Repositories\PostsRepository
    */
    protected $posts;

    /**
     * @var \App\Repositories\QuotesRepository
    */
    protected $quotes;

    public function __construct(PostsRepository $posts, QuotesRepository $quotes) {
        $this->posts = $posts;
        $this->quotes = $quotes;
    }

    /**
     *  Home page
     *
     * @return Illuminate\Support\Facades\Response
    */
    public function home()
    {
        $posts = $this->posts->latest();
        $quotes = $this->quotes->latest();

        return view('pages.home', [
            'lastPost' => $posts[0],
            'posts' => $posts->slice(1),
            'quotes' => $quotes,
        ]);
    }
}
