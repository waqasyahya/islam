<?php

namespace App\Http\Controllers;


use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function getNotifications()
    {
        $currentTime = Carbon::now()->format('H:i:00'); // Current time

        // Fetch notifications for the current time
        $notifications = Notification::where('notify_time', $currentTime)
                                      ->where('is_sent', false)
                                      ->get();

        // Mark notifications as sent
        foreach ($notifications as $notification) {
            $notification->is_sent = true;
            $notification->save();
        }
        addLog('User notification', [

            'status' => 'Success',
        ]);
        $notifications = [
            [
                'message' => 'Test Notification for Asr Prayer',
            ],
            [
                'message' => 'Test Notification for Maghrib Prayer',
            ]
        ];

        // return view('islame', ['notifications' => $notifications]);
        return response()->json($notifications);
    }
}
