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
    ->name('tweets')
    ->group(
        function () {
            Route::get('/', [TwitterController::class, 'getTweets']);
            Route::get('get/{tweetId}', [TwitterController::class, 'getTweet']);
            Route::get('search/recent/{query}', [TwitterController::class, 'searchRecent']);
            Route::get('search/all/{query}', [TwitterController::class, 'searchAll']);
            Route::get('user/tweets/{userId}', [TwitterController::class, 'userTweets']);
            Route::get('user/mentions/{userId}', [TwitterController::class, 'userMentions']);

            Route::get('stream', [TwitterController::class, 'getStream']);
            Route::get('stream/rules', [TwitterController::class, 'getStreamRules']);
            Route::get('stream/rules/post', [TwitterController::class, 'postStreamRules']);
            Route::get('stream/sampled', [TwitterController::class, 'getSampledStream']);

            Route::get('user/{userId}', [TwitterController::class, 'getUser']);
            Route::get('users', [TwitterController::class, 'getUsers']);
            Route::get('user/username/{username}', [TwitterController::class, 'getUserByUsername']);
            Route::get('users/usernames', [TwitterController::class, 'getUsersByUsernames']);

            Route::get('following/{userId}', [TwitterController::class, 'getFollowing']);
            Route::get('followers/{userId}', [TwitterController::class, 'getFollowers']);
            Route::get('follow/{sourceUserId}/{targetUserId}', [TwitterController::class, 'follow']);
            Route::get('unfollow/{sourceUserId}/{targetUserId}', [TwitterController::class, 'unfollow']);

            Route::get('hide/{tweetId}', [TwitterController::class, 'hideTweet']);
        }
    );
