<?php

namespace Pharaoh\Logger\Commands;

use Illuminate\Console\Command;
use Pharaoh\Logger\Facades\Logger;

class DestroyLogCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'destroy:logs {--destroy_days=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '清除Log資料指令';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $destroyDays = $this->option('destroy_days') ?? config('logger.destroy_days');
        $destroyDate = now()->subDays(intval($destroyDays))->toDateString();

        foreach (config('logger.log_folders') as $folder) {
            Logger::destroy($folder, $destroyDate);
            $this->line('Delete ' . $destroyDate . ' ' . $folder . ' log is done. ');
        }

        return 0;
    }
}
