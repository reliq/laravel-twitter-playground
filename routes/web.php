<?php

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

Route::prefix('tweet')
    ->middleware('auth')
    ->name('tweet')
    ->group(
        function () {
            Route::get('/', [TwitterController::class, 'tweet']);
            Route::post('/', [TwitterController::class, 'postTweet']);
        }
    );
