<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        return response()->json($posts->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
