<?php

namespace Pharaoh\Logger\commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Pharaoh\Logger\facades\Logger;

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
        $destroyDays = $this->option('destroy_days') ?? config('logger.destroyDays');
        $destroyDate = Carbon::now()->subDays(intval($destroyDays))->toDateString();

        foreach (config('logger.logFolder') as $folder) {
            Logger::destroy($folder, $destroyDate);
            $this->line('Delete ' . $destroyDate . ' ' . $folder . ' log is done. ');
        }

        return 0;
    }
}
