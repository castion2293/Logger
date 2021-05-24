<?php

namespace Pharaoh\Logger\Controllers;

use Illuminate\Routing\Controller as BaseController;

class LogListController extends BaseController
{
    public function index()
    {
        $logFolders = config('logger.log_folders');

        return view('pharaoh_logger::list', ['logFolders' => $logFolders]);
    }
}
