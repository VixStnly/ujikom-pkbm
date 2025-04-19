<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function fetch()
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->latest()
            ->take(4)
            ->get();

        $unreadCount = Notification::where('user_id', auth()->id())
            ->where('is_read', false)
            ->count();

        return view('content.notification-siswa', compact('notifications', 'unreadCount'));
    }

    public function readAll()
    {
        Notification::where('user_id', auth()->id())
            ->update(['is_read' => true]);

        return back();
    }
}
