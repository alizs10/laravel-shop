<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function readAll()
    {
        $unreadNotifications = Notification::where(['read_at' => null, 'type' => 'App\Notifications\Admin\PostCreated'])->get();
        foreach ($unreadNotifications as $notification) {
            $notification->update([
                'read_at' => now()
            ]);
        }

        return response()->json(
            [
                'message' => 'Your notifications have been successfully read',
                'status' => true
            ]
        )->setStatusCode(200);
    }
}
