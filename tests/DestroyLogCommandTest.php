<?php

namespace Pharaoh\Logger\Tests;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Pharaoh\Logger\facades\Logger;

class DestroyLogCommandTest extends BaseTestCase
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

    public function testDestroyLogCommand()
    {
        // Arrange
        $this->travel(-4)->months();
        Logger::info($this->folder, $this->message);

        $this->travelBack();
        Logger::info($this->folder, $this->message);

        $destroyDate = now()->subDays(config('logger.destroy_days'))->toDateString();

        config()->set(['logger.log_folders' => [$this->folder]]);

        // Act
        $this->artisan('destroy:logs')
            ->expectsOutput('Delete ' . $destroyDate . ' ' . $this->folder . ' log is done. ');

        // Assert
        $file = glob(storage_path("/logs/{$this->folder}/*"));
        $this->assertCount(1, $file);
        $folderName = Arr::first($file);
        $this->assertStringEndsNotWith($folderName, now()->toDateString());
    }
}
