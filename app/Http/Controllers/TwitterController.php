<?php
/** @noinspection ForgottenDebugOutputInspection */

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Concern\FilteredStream;
use App\Http\Controllers\Concern\Follows;
use App\Http\Controllers\Concern\HideReplies;
use App\Http\Controllers\Concern\SearchTweets;
use App\Http\Controllers\Concern\Timelines;
use App\Http\Controllers\Concern\TweetLookup;
use App\Http\Controllers\Concern\UserLookup;
use Atymic\Twitter\Facade\Twitter;

class TwitterController extends Controller
{
    use TweetLookup;
    use SearchTweets;
    use Timelines;
    use FilteredStream;
    use UserLookup;
    use Follows;
    use HideReplies;

    public function adHoc(): void
    {
        $querier = Twitter::forApiV2()
            ->getQuerier();
        $result = $querier
            ->withOAuth2Client()
            ->get('tweets/counts/recent', ['query' => 'foo']);

        dd($result);
    }
}
