<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    /**
     *  Home page
     *
     * @return Illuminate\Support\Facades\Response
    */
    public function home()
    {
        $posts = Post::limit(20)->orderByDesc('created_at')->get();

        return view('pages.home', [
            'lastPost' => $posts[0],
            'posts' => $posts->slice(1),
        ]);
    }
}
