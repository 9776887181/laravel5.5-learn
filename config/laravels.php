<?php
/**
 * @see https://github.com/hhxsv5/laravel-s/blob/master/Settings-CN.md  Chinese
 * @see https://github.com/hhxsv5/laravel-s/blob/master/Settings.md  English
 */
return [
    'listen_ip'                => env('LARAVELS_LISTEN_IP', 'workspace'),
    'listen_port'              => env('LARAVELS_LISTEN_PORT', 5200),
    'socket_type'              => defined('SWOOLE_SOCK_TCP') ? SWOOLE_SOCK_TCP : 1,
    'enable_coroutine_runtime' => false,
    'server'                   => env('LARAVELS_SERVER', 'LaravelS'),
    'handle_static'            => env('LARAVELS_HANDLE_STATIC', false),
    'laravel_base_path'        => env('LARAVEL_BASE_PATH', base_path()),
    'inotify_reload'           => [
        'enable'        => env('LARAVELS_INOTIFY_RELOAD', false),
        'watch_path'    => base_path(),
        'file_types'    => ['.php'],
        'excluded_dirs' => [],
        'log'           => true,
    ],
    'event_handlers'           => [],
    'websocket'                => [
        'enable' => true,
        'handler' => App\Services\WebSocketService::class,
    ],
    'sockets'                  => [],
    'processes'                => [],
    'timer'                    => [
        'enable'        => true,
        'jobs'          => [
            \App\Jobs\Timer\TestCronJob::class,
        ],
        'max_wait_time' => 5,
    ],
    'events'                   => [
        \App\Events\TestEvent::class => [
            \App\Listeners\TestListener::class,
            \App\Listeners\Test1Listener::class,
        ],
    ],
    'swoole_tables'            => [],
    'register_providers'       => [],
    'cleaners'                 => [],
    'swoole'                   => [
        'daemonize'          => env('LARAVELS_DAEMONIZE', false),
        'dispatch_mode'      => 2,
        'reactor_num'        => function_exists('swoole_cpu_num') ? swoole_cpu_num() * 2 : 4,
        'worker_num'         => function_exists('swoole_cpu_num') ? swoole_cpu_num() * 2 : 8,
        'task_worker_num'    => function_exists('swoole_cpu_num') ? swoole_cpu_num() * 2 : 8,
        'task_ipc_mode'      => 1,
        'task_max_request'   => 8000,
        'task_tmpdir'        => @is_writable('/dev/shm/') ? '/dev/shm' : '/tmp',
        'max_request'        => 8000,
        'open_tcp_nodelay'   => true,
        'pid_file'           => storage_path('laravels.pid'),
        'log_file'           => storage_path(sprintf('logs/swoole-%s.log', date('Y-m'))),
        'log_level'          => 4,
        'document_root'      => base_path('public'),
        'buffer_output_size' => 2 * 1024 * 1024,
        'socket_buffer_size' => 128 * 1024 * 1024,
        'package_max_length' => 4 * 1024 * 1024,
        'reload_async'       => true,
        'max_wait_time'      => 60,
        'enable_reuse_port'  => true,
        'enable_coroutine'   => false,
        'http_compression'   => false,

         // 表示每60秒遍历一次，一个连接如果600秒内未向服务器发送任何数据，此连接将被强制关闭
        'heartbeat_idle_time'      => 600,
        'heartbeat_check_interval' => 60,

        /**
         * More settings of Swoole
         * @see https://wiki.swoole.com/wiki/page/274.html  Chinese
         * @see https://www.swoole.co.uk/docs/modules/swoole-server/configuration  English
         */
    ],
];
