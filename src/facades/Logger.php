<?php

namespace Pharaoh\Logger\facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class OperationRecord
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
