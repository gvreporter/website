<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\PostsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\QuotesRepository;
use App\Repositories\UsersRepository;

class DashboardController extends Controller
{
    /**
     * @var \App\Repositories\QuotesRepository
    */
    protected $quotes;

    /**
     * @var \App\Repositories\UsersRepository
    */
    protected $users;

    /**
     * @var \App\Repositories\PostsRepository
    */
    protected $posts;

    public function __construct(QuotesRepository $quotes, UsersRepository $users, PostsRepository $posts) {
        $this->quotes = $quotes;
        $this->users = $users;
        $this->posts = $posts;
    }

    public function home()
    {
        $pendingApproveQuotes = $this->quotes->pendingApprove();
        $users = $this->users->last();
        $posts = $this->posts->latest(10);

        return view('pages.admin.home', [
            'approvingQuotes' => $pendingApproveQuotes,
            'users' => $users,
            'posts' => $posts,
        ]);
    }

}
