<?php

namespace App\Services;

use App\Models\Log;

class LogService
{
    /**
     * Fetch user logs or activity
     *
     * @param $id
     * @return void
     */
    public function showSingleUserLogs($id)
    {
       return Log::where('user_id', $id)->latest()->paginate(config('constants.global.pagination'));
    }
}

