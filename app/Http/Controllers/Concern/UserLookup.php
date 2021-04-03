<?php

declare(strict_types=1);

namespace App\Http\Controllers\Concern;

use Atymic\Twitter\Twitter as TwitterContract;
use Twitter;

trait UserLookup
{
    public function getUser(int $userId): void
    {
        $params = [
            'tweet.fields' => 'author_id,geo',
            TwitterContract::KEY_RESPONSE_FORMAT => TwitterContract::RESPONSE_FORMAT_ARRAY,
        ];

        $tweet = Twitter::getUser($userId, $params);

        dd($tweet);
    }

    public function getUsers(): void
    {
        $userIds = ['942865358,4609936283'];
        $params = [
            'tweet.fields' => 'author_id,geo',
        ];

        $result = Twitter::getUsers($userIds, $params);

        dd($result);
    }

    public function getUserByUsername(string $username): void
    {
        $params = [
            TwitterContract::KEY_RESPONSE_FORMAT => TwitterContract::RESPONSE_FORMAT_OBJECT,
        ];
        $result = Twitter::getUserByUsername($username, $params);

        dd($result);
    }

    public function getUsersByUsernames(): void
    {
        $usernames = ['iamreliq', 'twitterdev'];
        $params = [
            'tweet.fields' => 'author_id,geo',
            TwitterContract::KEY_RESPONSE_FORMAT => TwitterContract::RESPONSE_FORMAT_OBJECT,
        ];

        $result = Twitter::getUsersByUsernames($usernames, $params);

        dd($result);
    }
}
