<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Concern\HideReplies;
use App\Http\Controllers\Concern\SearchTweets;
use App\Http\Controllers\Concern\Timelines;
use App\Http\Controllers\Concern\TweetLookup;

class TwitterController extends Controller
{
    use TweetLookup;
    use SearchTweets;
    use Timelines;
    use HideReplies;
}
