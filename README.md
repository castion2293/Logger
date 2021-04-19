# LOG紀錄-收集器

可以歸類成不同資料夾，並以日期及小時做分類

```
logs
├── api
│   └── 2021-04-19
│       └── 14.log
└── crontab
    └── 2021-04-16
        └── 13.log

```

然後搭配 ap2hpoutre/laravel-log-viewer 套件，可以顯示Log視窗

## 安裝
你可以使用 composer 做安裝
```bash
composer require thoth-pharaoh/logger
```

匯出 Config
```bash
php artisan vendor:publish --tag=logger-config --force
```

註冊 sport-logs/{folder} 路由

RouteServiceProvider
```bash
 public function boot()
 {
   $this->routes(function () {
      Logger::routes();
      
      ....
    });
 }
```
至路由 ```http://domain/sport-logs/{folder}``` 即可看到Log畫面
>  folder為Log資料夾名稱 可以至 config/logger.php 中 log_folders 欄位添加

## 使用方法

### 使用 Facade:

先引入門面
```bash
use Pharaoh\Logger\Facades\Logger;
```

建立Log:

```bash
Logger::debug($folder, $message);
Logger::info($folder, $message);
Logger::notice($folder, $message);
Logger::warning($folder, $message);
Logger::error($folder, $message);
Logger::critical($folder, $message);
Logger::alert($folder, $message);
Logger::emergency($folder, $message);
```

| 參數 | 說明 | 類型 | 範例 |
| ------------|:----------------------- | :------| :------|
| $folder | Log資料夾 | string | api |
| $message | Log訊息 | array | ['error' => 'somethings went wrong'] |

清除Log:
```bash
Logger::destroy($folder, $destroyDate);
```

| 參數 | 說明 | 類型 | 範例 |
| ------------|:----------------------- | :------| :------|
| $folder | Log資料夾 | string | api |
| $destroyDate | 此日期以前的紀錄做清除 | string | 2021-03-01(意指 2021-02-28以前的紀錄做清除) |

也可以使用 Artisan Command 方便放到 Schedule 裡做定期清除任務

```bash
php artisan destroy:logs {--destroy_days=}
```

| 參數 | 說明 | 類型 | 範例 |
| ------------|:----------------------- | :------| :------|
| --destroy_days | 保留幾天內的Log紀錄 | int | 30 |

>  destroy_days 不給就是以 config.logger.php 中 destroy_days 欄位為主
