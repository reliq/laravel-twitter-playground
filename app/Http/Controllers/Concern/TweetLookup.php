<?php

declare(strict_types=1);

namespace App\Http\Controllers\Concern;

use Atymic\Twitter\Twitter as TwitterContract;
use Twitter;

trait TweetLookup
{
    public function getTweet(int $tweetId): void
    {
        $params = [
            'place.fields' => 'country,name',
            'tweet.fields' => 'author_id,geo',
            'expansions' => 'author_id,in_reply_to_user_id',
            TwitterContract::KEY_RESPONSE_FORMAT => TwitterContract::RESPONSE_FORMAT_ARRAY,
        ];

        $tweet = Twitter::getTweet($tweetId, $params);

        dd($tweet);
    }

    public function getTweets(): void
    {
        $tweetIds = ['1353121400341594113,1373760060904587266', 1346519695550259202];
        $params = [
            'place.fields' => 'country,name',
            'tweet.fields' => 'author_id,geo',
            'expansions' => 'author_id,in_reply_to_user_id',
        ];

        $tweets = Twitter::getTweets($tweetIds, $params);

        dd($tweets);
    }
}
