<?php

declare(strict_types=1);

namespace App\Http\Controllers\Concern;

use Atymic\Twitter\Twitter as TwitterContract;
use Twitter;

trait SearchTweets
{
    public function searchRecent(string $query): void
    {
        $params = [
            'place.fields' => 'country,name',
            'tweet.fields' => 'author_id,geo',
            'expansions' => 'author_id,in_reply_to_user_id',
            TwitterContract::KEY_RESPONSE_FORMAT => TwitterContract::RESPONSE_FORMAT_ARRAY,
        ];

        $results = Twitter::searchRecent($query, ...$params);

        dd($results);
    }
}
