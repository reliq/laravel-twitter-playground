<?php

use App\Http\Controllers\ApiV1\TwitterController as ApiV1TwitterController;
use App\Http\Controllers\TwitterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ . '/auth.php';

Route::get(
    '/',
    function () {
        return view('welcome');
    }
);

Route::get(
    '/dashboard',
    function () {
        return view('dashboard');
    }
)->middleware(['auth'])->name('dashboard');

Route::prefix('v1/tweets')
    ->middleware('auth')
    ->name('v1.tweet')
    ->group(
        function () {
            Route::get('/', [ApiV1TwitterController::class, 'tweet']);
            Route::post('/', [ApiV1TwitterController::class, 'postTweet']);
            Route::get('get', [ApiV1TwitterController::class, 'getTweet']);
        }
    );


Route::prefix('tweets')
    ->middleware('auth')
    ->name('tweet-lookup')
    ->group(
        function () {
            Route::get('/', [TwitterController::class, 'getTweets']);
            Route::get('get/{tweetId}', [TwitterController::class, 'getTweet']);
            Route::get('search/recent/{query}', [TwitterController::class, 'searchRecent']);
            Route::get('user/tweets/{userId}', [TwitterController::class, 'userTweets']);
            Route::get('user/mentions/{userId}', [TwitterController::class, 'userMentions']);
            Route::get('get-stream-rules', [TwitterController::class, 'getStreamRules']);
            Route::get('hide/{tweetId}', [TwitterController::class, 'hideTweet']);
        }
    );
