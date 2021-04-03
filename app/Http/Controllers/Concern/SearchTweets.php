<?php

declare(strict_types=1);

namespace App\Http\Controllers\Concern;

use Atymic\Twitter\Twitter as TwitterContract;
use Illuminate\Http\JsonResponse;
use Twitter;

trait SearchTweets
{
    public function searchRecent(string $query): JsonResponse
    {
        $params = [
            'place.fields' => 'country,name',
            'tweet.fields' => 'author_id,geo',
            'expansions' => 'author_id,in_reply_to_user_id',
            TwitterContract::KEY_RESPONSE_FORMAT => TwitterContract::RESPONSE_FORMAT_JSON,
        ];

        return JsonResponse::fromJsonString(Twitter::searchRecent($query, $params));
    }

    public function searchAll(string $query): void
    {
        $params = [
            'place.fields' => 'country,name',
            'tweet.fields' => 'author_id,geo',
            'expansions' => 'author_id,in_reply_to_user_id',
            TwitterContract::KEY_RESPONSE_FORMAT => TwitterContract::RESPONSE_FORMAT_ARRAY,
        ];

        $results = Twitter::searchAll($query, $params);

        dd($results);
    }
}
