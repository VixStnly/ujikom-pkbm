<?php

namespace App\Http\Controllers;
use App\Models\User;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function fetch(Request $request)
    {
        // Ambil notifikasi berdasarkan user yang sedang login
        $user = auth()->user();
        $notifications = $user->notifications()->latest()->limit(5)->get();  // Ambil 5 notifikasi terbaru
        $unreadCount = $notifications->where('is_read', false)->count();

        // Kembalikan data notifikasi dan unreadCount
        return response()->json([
            'notifications' => $notifications,
            'unreadCount' => $unreadCount
        ]);
    }
    

public function readAll()
{
    $user = auth()->user();

    Notification::where('user_id', $user->id)
        ->where('is_read', false)
        ->update(['is_read' => true]);

    return back(); // Kembali ke halaman sebelumnya
}


}
