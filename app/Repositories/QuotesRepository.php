<?php
namespace App\Repositories;

use App\Models\Quote;
use Illuminate\Database\Eloquent\Collection;

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
     * @param null|string $ip The poster's IP
     *
     * @return \App\Models\Post
    */
    public function storeQuote(string $message, ?string $ip): Quote
    {
        if($ip) {
            $last = $this->lastFromIP($ip);
            if($last) {
                $now = date_create();
                $diff = date_diff($last->created_at, $now);
                // Abort if the last quote sent is from a less day ago
                if($diff->format('%d') < 1) return abort(401);
            }
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

    /**
     * Fetch the latest posted quotes
     *
     * @param int $count The quantity of the quotes to retrive
     * @param bool $showApproved Return only approved quotes
     *
     * @return \Illuminate\Database\Eloquent\Collection
    */
    public function latest(int $count = 20, bool $showApproved = true): Collection
    {
        if($showApproved) {
            return Quote::where('approved', '1')->limit($count)->orderBy('created_at', 'desc')->get();
        } else {
            return Quote::limit($count)->orderBy('created_at', 'desc')->get();
        }
    }

    /**
     * Fetch the latest not yet approved quotes
     *
     * @param int $count The quantity of the quotes to retrive
     *
     * @return \Illuminate\Database\Eloquent\Collection
    */
    public function pendingApprove(int $count = 20): Collection
    {
        return Quote::where('approved', '0')->limit($count)->orderBy('created_at', 'desc')->get();
    }

    /**
     * Find a quote by its id
     *
     * @param int $id
     * @return \App\Models\Quote
    */
    public function findById(int $id): ?Quote
    {
        return Quote::where('id', $id)->first();
    }
}
