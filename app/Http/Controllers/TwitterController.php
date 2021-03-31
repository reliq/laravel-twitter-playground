<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Concern\FilteredStream;
use App\Http\Controllers\Concern\Follows;
use App\Http\Controllers\Concern\HideReplies;
use App\Http\Controllers\Concern\SearchTweets;
use App\Http\Controllers\Concern\Timelines;
use App\Http\Controllers\Concern\TweetLookup;
use App\Http\Controllers\Concern\UserLookup;

class TwitterController extends Controller
{
    use TweetLookup;
    use SearchTweets;
    use Timelines;
    use FilteredStream;
    use UserLookup;
    use Follows;
    use HideReplies;
}
