<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServerStatusController extends Controller
{
    public function index()
    {
        // Check database connection
        try {
            DB::connection()->getPdo();
            $databaseStatus = "Connected";
        } catch (\Exception $e) {
            $databaseStatus = "Not Connected: " . $e->getMessage();
        }

        // Get server uptime
        $uptime = shell_exec('uptime -p') ?? 'Uptime not available';

        // Get disk space usage
        $diskSpace = disk_free_space("/") / disk_total_space("/") * 100;
        $diskUsage = round(100 - $diskSpace, 2) . "% Used";

        // Queue Status (if using Laravel Queues)
        $queueStatus = shell_exec('php artisan queue:failed') ? "Some jobs failed" : "No failed jobs";

        return view('server-status', compact('databaseStatus', 'uptime', 'diskUsage', 'queueStatus'));
    }
}