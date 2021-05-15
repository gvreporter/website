<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\QuotesRepository;

class DashboardController extends Controller
{
    /**
     * @var \App\Repositories\QuotesRepository
    */
    protected $quotes;

    public function __construct(QuotesRepository $quotes) {
        $this->quotes = $quotes;
    }

    public function home()
    {
        $pendingApproveQuotes = $this->quotes->pendingApprove();
        return view('pages.admin.home', ['approvingQuotes' => $pendingApproveQuotes]);
    }

}
