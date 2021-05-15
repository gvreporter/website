<?php
namespace App\Repositories;

use App\Models\Quote;

/**
 * Repository for all quotes, a.k.a. sputi
 *
 * Use this repository to interact with quotes in the DB
 *
*/
class QuotesRepository {
    /**
     * Store a new quote
     *
     * @param string $message The contents of the quote
     * @param string $ip The poster's IP
     *
     * @return \App\Models\Post
    */
    public function storeQuote(string $message, string $ip): Quote
    {
        $last = $this->lastFromIP($ip);
        if($last) {
            $now = date_create();
            $diff = date_diff($last->created_at, $now);
            // Abort if the last quote sent is from a less day ago
            if($diff->format('%d') < 1) return abort(401);
        }

        $quote = new Quote;
        $quote->message = $message;
        $quote->ip = $ip;
        $quote->save();

        return $quote;
    }

    public function lastFromIP(string $ip): ?Quote
    {
        return Quote::where('ip', $ip)->orderBy('created_at', 'desc')->first();
    }

    public function latest(int $count = 20)
    {
        return Quote::limit($count)->get();
    }
}
