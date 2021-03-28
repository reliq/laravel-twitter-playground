<?php

declare(strict_types=1);

namespace App\Http\Controllers\Concern;

use Atymic\Twitter\Twitter as TwitterContract;
use Twitter;

trait Follows
{
    public function getFollowing(int $userId)
    {
        $result = Twitter::getFollowing($userId);

        dd($result);
    }

    public function getFollowers(int $userId)
    {
        $result = Twitter::getFollowers($userId);

        dd($result);
    }

    public function follow(int $sourceUserId, int $targetUserId)
    {
        $result = Twitter::follow($sourceUserId, $targetUserId);

        dd($result);
    }

    public function unfollow(int $sourceUserId, int $targetUserId)
    {
        $result = Twitter::unfollow($sourceUserId, $targetUserId);

        dd($result);
    }
}
