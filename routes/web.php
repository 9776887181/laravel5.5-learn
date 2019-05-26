<?php

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

use Hhxsv5\LaravelS\Swoole\Task\Event;

Route::get('/', function () {
    $result = Event::fire(new App\Events\TestEvent('event data'));
    dump($result);
    return request();
    return view('welcome');
});
