<?php

namespace Pharaoh\Logger;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class LoggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        parent::register();

        $loader = AliasLoader::getInstance();
        $loader->alias('logger', 'Pharaoh\Logger\Logger');

        $this->loadViewsFrom(__DIR__ . '/views', 'pharaoh_logger');
    }
}
