<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\QuotesRepository;

class QuotesController extends Controller
{

    /**
     * @var \App\Repositories\QuotesRepository
    */
    protected $quotes;

    public function __construct(QuotesRepository $quotes) {
        $this->quotes = $quotes;
    }


    public function store(Request $request)
    {
        $this->quotes->storeQuote($request->get('message'), $request->ip());
        return back();
    }
}
