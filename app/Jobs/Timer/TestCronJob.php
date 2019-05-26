<?php

namespace App\Jobs\Timer;

use App\Tasks\TestTask;
use Swoole\Coroutine;
use Hhxsv5\LaravelS\Swoole\Task\Task;
use Hhxsv5\LaravelS\Swoole\Timer\CronJob;

class TestCronJob extends CronJob
{
    public function interval()
    {
        return 10000;
    }

    public function isImmediate()
    {
        return true;
    }

    public function run()
    {
        \Log::info('666 888');
    }
}
