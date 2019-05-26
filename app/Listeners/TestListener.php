<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Hhxsv5\LaravelS\Swoole\Task\Task;
use Hhxsv5\LaravelS\Swoole\Task\Event;
use Hhxsv5\LaravelS\Swoole\Task\Listener;

class TestListener extends Listener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        \Log::info(__CLASS__ . ':handle start', [$event->getData()]);
        sleep(2);// 模拟一些慢速的事件处理
        // 监听器中也可以投递Task，但不支持Task的finish()回调。
        // 注意：
        // 1.参数2需传true
        // 2.config/laravels.php中修改配置task_ipc_mode为1或2，参考 https://wiki.swoole.com/wiki/page/296.html
        $ret = Task::deliver(new \App\Task\TestTask('task data777777'), true);
        var_dump($ret);
        // throw new \Exception('an exception');// handle时抛出的异常上层会忽略，并记录到Swoole日志，需要开发者try/catch捕获处理
    }
}
