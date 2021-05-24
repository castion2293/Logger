<?php

namespace Pharaoh\Logger;

use Carbon\Carbon;
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

    /**
     * 各種寫Log紀錄的方法
     *
     * @param $method
     * @param $arguments
     * @throws \Exception
     */
    public function __call($method, $arguments)
    {
        if (!isset($this->levels[$method])) {
            throw new \Exception('Can not find log method.');
        }

        list($folder, $data) = $arguments;

        $logger = new \Monolog\Logger($folder);
        $filename = storage_path('logs/' . $folder . '/' . now()->toDateString() . '/' . date('H') . '.log');
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
        Route::get('logs', 'Pharaoh\Logger\Controllers\LogListController@index');
        Route::get('logs/{folder}', 'Pharaoh\Logger\Controllers\LogViewController@index');
    }

    /**
     * 請除Log方法
     *
     * @param string $folder
     * @param string $destroyDate
     */
    public function destroy(string $folder, string $destroyDate): void
    {
        // 取得Log分類資料夾
        $path = storage_path("logs/{$folder}/");
        if (!is_dir($path)) {
            return;
        }

        // 取得日期資料夾
        $folders = array_diff(scandir($path), ['.', '..', '.DS_Store']);
        if (empty($folders)) {
            return;
        }

        foreach ($folders as $folderName) {
            if (Carbon::parse($folderName)->greaterThan(Carbon::parse($destroyDate))) {
                continue;
            }

            // 做刪除動作
            $filePath = $path . $folderName;
            $files = glob($filePath . '/*');

            foreach ($files as $file) {
                // TODO: 上傳至第三方儲存 ex: S3

                unlink($file);
            }

            rmdir($filePath);
        }
    }
}
