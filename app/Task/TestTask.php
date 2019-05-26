<?php

namespace App\Task;

use Hhxsv5\LaravelS\Swoole\Task\Task;

class TestTask extends Task
{
    private $data;
    private $result;

    public function __construct($data)
    {
        $this->data = $data;
    }

    // 处理任务的逻辑，运行在Task进程中，不能投递任务
    public function handle()
    {
        \Log::info(__CLASS__ . ':handler start', [$this->data]);
        sleep(2);

        $this->result = 'the result of ' . $this->data;
    }

    // 可选的，完成事件，任务处理完后的逻辑，运行在Worker进程中，可以投递任务
    public function finish()
    {
        \Log::info(__CLASS__ . ':finish start', [$this->result]);
        Task::deliver(new Test1Task('test1'));
    }
}
