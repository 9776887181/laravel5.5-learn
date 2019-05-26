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

// 实例化TestTask并通过deliver投递，此操作是异步的，投递后立即返回，由Task进程继续处理TestTask中的handle逻辑
use Hhxsv5\LaravelS\Swoole\Task\Task;

Route::get('/', function () {
    $result = Event::fire(new App\Events\TestEvent('event data'));
    // dump($result);

    // dump(Task::deliver(new \App\Task\TestTask('ooooo')));

    return request();
    return view('welcome');
});
