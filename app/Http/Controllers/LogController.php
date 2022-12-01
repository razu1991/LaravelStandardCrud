<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Services\LogService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class LogController extends Controller
{
    protected $logService;


    /**
     * Assign instance of log service class
     *
     * @param LogService $logService
     */
    public function __construct(LogService $logService)
    {
        $this->logService = $logService;
    }

    /**
     * Display single user wise logs
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function index($id)
    {
        $title = "User Log List | Standard CRUD 1.0";

        // Fetch user log via log service class
        $logs = $this->logService->showSingleUserLogs($id);

        return view('logs', compact('logs', 'title'));
    }
}
