<?php

namespace Pharaoh\Logger;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;

class Logger
{
    private $levels = [
        'debug' => \Monolog\Logger::DEBUG,
        'info' => \Monolog\Logger::INFO,
        'notice' => \Monolog\Logger::NOTICE,
        'warning' => \Monolog\Logger::WARNING,
        'error' => \Monolog\Logger::ERROR,
        'critical' => \Monolog\Logger::CRITICAL,
        'alert' => \Monolog\Logger::ALERT,
        'emergency' => \Monolog\Logger::EMERGENCY,
    ];

    public function __call($method, $arguments)
    {
        if (!isset($this->levels[$method])) {
            throw new \Exception('Can not find log method.');
        }

        list($folder, $data) = $arguments;

        $logger = new \Monolog\Logger($folder);
        $filename = storage_path('logs/' . $folder . '/' . date('Y-m-d') . '/' . date('H') . '.log');
        $streamHandler = new StreamHandler($filename, Arr::get($this->levels, $method));
        $streamHandler->setFormatter(new LineFormatter(null, 'Y-m-d H:i:s'));
        $logger->pushHandler($streamHandler);
        $logger->$method(json_encode($data));
    }

    /**
     * 註冊Log路由
     */
    public function routes()
    {
        Route::get('sport-logs/{folder}', 'Pharaoh\Logger\Controllers\LogViewController@index');
    }
}
