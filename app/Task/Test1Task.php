<?php

namespace App\Task;

use Hhxsv5\LaravelS\Swoole\Task\Task;

class Test1Task extends Task
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        \Log::info(__CLASS__ . ':handle start', [$this->data]);
        sleep(10);
    }

    public function finish()
    {
        \Log::info(__CLASS__ . ':finish start');
    }
}
