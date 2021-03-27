<?php

declare(strict_types=1);

namespace App\Http\Controllers\Concern;

use Atymic\Twitter\Twitter as TwitterContract;
use Twitter;

trait Timelines
{
    public function userTweets(int $userId): void
    {
        $params = [
            'place.fields' => 'country,name',
            'tweet.fields' => 'author_id,geo',
            'expansions' => 'author_id,in_reply_to_user_id',
            TwitterContract::KEY_RESPONSE_FORMAT => TwitterContract::RESPONSE_FORMAT_ARRAY,
        ];

        $results = Twitter::userTweets($userId, ...$params);

        dd($results);
    }

    public function userMentions(int $userId): void
    {
        $params = [
            'place.fields' => 'country,name',
            'tweet.fields' => 'author_id,geo',
            'expansions' => 'author_id,in_reply_to_user_id',
            TwitterContract::KEY_RESPONSE_FORMAT => TwitterContract::RESPONSE_FORMAT_ARRAY,
        ];

        $results = Twitter::userMentions($userId, ...$params);

        dd($results);
    }
}
