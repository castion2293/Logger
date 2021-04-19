<?php

namespace Pharaoh\Logger\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Logger
 *
 * @see \Pharaoh\Logger\Logger
 */
class Logger extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        // 回傳 alias 的名稱
        return 'logger';
    }
}
