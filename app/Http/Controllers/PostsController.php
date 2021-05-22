<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Post;
use App\Repositories\CommentsRepository;
use Illuminate\Http\Request;
use App\Repositories\PostsRepository;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{

    /**
     * @var \App\Repositories\PostsRepository
    */
    protected $posts;

    /**
     * @var \App\Repositories\CommentsRepository
    */
    protected $comments;

    public function __construct(PostsRepository $posts, CommentsRepository $comments) {
        $this->posts = $posts;
        $this->comments = $comments;
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
        if(!$post) return abort(404);

        $comments = $this->comments->postComments($post);

        return view('pages.posts.show', [
            'post' => $post,
            'comments' => $comments,
        ]);
    }

    /**
     * Comment a post
     *
     * @param string $slug
     * @param \App\Http\Requests\StoreCommentRequest
     *
     * @return \Illuminate\Http\Response
    */
    public function comment(string $slug, StoreCommentRequest $request)
    {
        $post = $this->posts->findBySlug($slug);
        if(!$post) return abort(404);

        $this->comments->commentPost($post, $request->get('comment'), Auth::user());

        return back()
            ->with(['success' => 'Il tuo commento è stato pubblicato correttamente!']);
    }
}
