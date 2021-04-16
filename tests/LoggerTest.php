<?php

namespace Pharaoh\Logger\Tests;

use Illuminate\Support\Arr;
use Pharaoh\Logger\facades\Logger;

class LoggerTest extends BaseTestCase
{
    /**
     * Log分類資料夾
     *
     * @var string
     */
    protected string $folder;

    /**
     * Log內容訊息
     *
     * @var array
     */
    protected array $message;


    public function setUp(): void
    {
        parent::setUp();

        $this->folder = 'api';
        $this->message = ['error' => 'somethings went wrong'];
    }

    /**
     * 測試Logger::debug()
     */
    public function testLogDebug()
    {
        // Act
        Logger::debug($this->folder, $this->message);

        // Assert
        $file = glob(storage_path("logs/{$this->folder}/*/*.log"));
        $this->assertCount(1, $file);
        $content = file_get_contents(Arr::first($file));
        $this->assertStringContainsString("{$this->folder}.DEBUG: ", $content);
        $this->assertStringContainsString(json_encode($this->message), $content);
    }

    /**
     * 測試Logger::info()
     */
    public function testLogInfo()
    {
        // Act
        Logger::info($this->folder, $this->message);

        // Assert
        $file = glob(storage_path("logs/{$this->folder}/*/*.log"));
        $this->assertCount(1, $file);
        $content = file_get_contents(Arr::first($file));
        $this->assertStringContainsString("{$this->folder}.INFO: ", $content);
        $this->assertStringContainsString(json_encode($this->message), $content);
    }

    /**
     * 測試Logger::notice()
     */
    public function testLogNotice()
    {
        // Act
        Logger::notice($this->folder, $this->message);

        // Assert
        $file = glob(storage_path("logs/{$this->folder}/*/*.log"));
        $this->assertCount(1, $file);
        $content = file_get_contents(Arr::first($file));
        $this->assertStringContainsString("{$this->folder}.NOTICE: ", $content);
        $this->assertStringContainsString(json_encode($this->message), $content);
    }

    /**
     * 測試Logger::warning()
     */
    public function testLogWarning()
    {
        // Act
        Logger::warning($this->folder, $this->message);

        // Assert
        $file = glob(storage_path("logs/{$this->folder}/*/*.log"));
        $this->assertCount(1, $file);
        $content = file_get_contents(Arr::first($file));
        $this->assertStringContainsString("{$this->folder}.WARNING: ", $content);
        $this->assertStringContainsString(json_encode($this->message), $content);
    }

    /**
     * 測試Logger::error()
     */
    public function testLogError()
    {
        // Act
        Logger::error($this->folder, $this->message);

        // Assert
        $file = glob(storage_path("logs/{$this->folder}/*/*.log"));
        $this->assertCount(1, $file);
        $content = file_get_contents(Arr::first($file));
        $this->assertStringContainsString("{$this->folder}.ERROR: ", $content);
        $this->assertStringContainsString(json_encode($this->message), $content);
    }

    /**
     * 測試Logger::critical()
     */
    public function testLogCritical()
    {
        // Act
        Logger::critical($this->folder, $this->message);

        // Assert
        $file = glob(storage_path("logs/{$this->folder}/*/*.log"));
        $this->assertCount(1, $file);
        $content = file_get_contents(Arr::first($file));
        $this->assertStringContainsString("{$this->folder}.CRITICAL: ", $content);
        $this->assertStringContainsString(json_encode($this->message), $content);
    }

    /**
     * 測試Logger::alert()
     */
    public function testLogAlert()
    {
        // Act
        Logger::alert($this->folder, $this->message);

        // Assert
        $file = glob(storage_path("logs/{$this->folder}/*/*.log"));
        $this->assertCount(1, $file);
        $content = file_get_contents(Arr::first($file));
        $this->assertStringContainsString("{$this->folder}.ALERT: ", $content);
        $this->assertStringContainsString(json_encode($this->message), $content);
    }

    /**
     * 測試Logger::emergency()
     */
    public function testLogEmergency()
    {
        // Act
        Logger::emergency($this->folder, $this->message);

        // Assert
        $file = glob(storage_path("logs/{$this->folder}/*/*.log"));
        $this->assertCount(1, $file);
        $content = file_get_contents(Arr::first($file));
        $this->assertStringContainsString("{$this->folder}.EMERGENCY: ", $content);
        $this->assertStringContainsString(json_encode($this->message), $content);
    }
}
