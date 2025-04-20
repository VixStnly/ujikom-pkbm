<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class MessageNotificationController extends Controller
{
    public function index()
    {
        $messages = Notification::where('user_id', auth()->id())
            ->where('type', 'message')
            ->latest()
            ->take(4)
            ->get();

        return view('content.messages-siswa', compact('messages'));
    }

    public function markAllRead()
    {
        Notification::where('user_id', auth()->id())
            ->where('type', 'message')
            ->update(['is_read' => true]);

        return back();
    }
}
