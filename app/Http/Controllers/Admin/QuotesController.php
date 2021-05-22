<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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


    public function approve(int $id)
    {
        $quote = $this->quotes->findById($id);
        if(!$quote) abort(404);

        $quote->approved = 1;
        $quote->save();

        return back()->with('success', 'Lo sputo è stato approvato!');
    }

    public function remove(int $id)
    {
        $quote = $this->quotes->findById($id);
        if(!$quote) abort(404);

        $quote->delete();

        return back()->with('success', 'Lo sputo è stato rimosso.');
    }
}
