<?php

namespace Database\Seeders;

use App\Models\Quote;
use Illuminate\Database\Seeder;

class QuotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quote = new Quote;
        $quote->message = "Sputo di test!";
        $quote->ip = "127.0.0.1";
        $quote->save();

        $quote = new Quote;
        $quote->message = "Altro sputo di test!";
        $quote->ip = "127.0.0.1";
        $quote->save();
    }
}
