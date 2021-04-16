<?php

namespace Pharaoh\Logger;

use Illuminate\Support\Facades\Route;

class Logger
{
    public function routes()
    {
        Route::get('log', 'Pharaoh\Logger\Controllers\LogViewController@index');
    }
}
