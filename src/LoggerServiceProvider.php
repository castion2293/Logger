<?php

namespace Pharaoh\Logger;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Pharaoh\Logger\Commands\DestroyLogCommand;

class LoggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/logger.php', 'logger');

        $this->loadViewsFrom(__DIR__ . '/Views', 'pharaoh_logger');

        $this->commands(
            [
                DestroyLogCommand::class
            ]
        );

        $this->publishes(
            [
                __DIR__ . '/../config/logger.php' => config_path('logger.php')
            ],
            'logger-config'
        );
    }

    public function register()
    {
        parent::register();

        $loader = AliasLoader::getInstance();
        $loader->alias('logger', 'Pharaoh\Logger\Logger');
    }
}
