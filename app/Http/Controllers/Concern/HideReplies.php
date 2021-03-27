<?php

declare(strict_types=1);

namespace App\Http\Controllers\Concern;

use Atymic\Twitter\Twitter as TwitterContract;
use Twitter;

trait HideReplies
{
    public function hideTweet(string $tweetId): void
    {
        $result = Twitter::hideTweet($tweetId, true);

        dd($result);
    }
}
