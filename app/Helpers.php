<?php

use App\Models\Roles;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;





if (!function_exists('custom_exception')) {
    function custom_exception($e) {
        switch ($e->getMessage()) {
            case "Internal Server Error":
                return response()->json(["status" => 500, "message" => "Internal Server Error"]);
                break;
            case "Not Found":
                return response()->json(["status" => 404, "message" => "Not Found"]);
                break;
            case "Unauthorized":
                return response()->json(["status" => 401, "message" => "Unauthorized"]);
                break;
            default:
                return response()->json(["status" => 422, "message" => $e->getMessage()]);
                break;
        }
    }



    if (!function_exists('addLog')) {
        /**
         * Add a custom log entry to the 'apprecord' log file.
         *
         * @param string $event The event type (e.g., 'User Registration', 'Login')
         * @param array $customData Custom data to include in the log
         */
        function addLog(string $event, array $customData = []): void
        {
            // Gather basic log details
            $logData = [
                'ip' => request()->ip(),
                'event' => $event,
                'date' => now()->format('Y-m-d'),
                'time' => now()->format('H:i:s'),
            ];

            // Merge custom data
            $logData = array_merge($logData, $customData);

            // Write log to the 'apprecord' channel
            Log::channel('apprecord')->info('Islameapp :', $logData);
        }
    }

}
