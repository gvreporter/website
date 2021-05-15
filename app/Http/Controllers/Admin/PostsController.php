<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use \App\Repositories\PostsRepository;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePostRequest;

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
        $title = $request->get('name');
        $cover = $request->get('cover');
        $content = $request->get('article');

        $this->posts->store($title, $cover, $content, Auth::user());

        return redirect()->route('dash');
    }

    /**
     * Render the post image
     *
     * @return \Illuminate\Support\Facades\Response
    */
    public function showImage(string $slug)
    {
        $post = $this->posts->findBySlug($slug);

        if(!$post) return abort(404);

        return $post->generateImage()->response('jpg');
    }
}
