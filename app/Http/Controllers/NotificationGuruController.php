<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotificationGuru;
use Illuminate\Support\Facades\Auth;

class NotificationGuruController extends Controller
{
    // Ambil semua notifikasi guru
    public function index()
    {
        $notifications = NotificationGuru::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('content.notification-guru', compact('notifications'));
    }

    // Tandai satu notifikasi sebagai sudah dibaca
    public function markAsRead($id)
    {
        $notif = NotificationGuru::where('user_id', Auth::id())->findOrFail($id);
        $notif->update(['is_read' => true]);

        return redirect()->back()->with('success', 'Notifikasi ditandai sudah dibaca.');
    }

    // Tandai semua notifikasi sebagai sudah dibaca
    public function markAllAsRead()
    {
        NotificationGuru::where('user_id', Auth::id())->update(['is_read' => true]);

        return redirect()->back()->with('success', 'Semua notifikasi ditandai sudah dibaca.');
    }public function readAndRedirect($id)
    {
        $notif = NotificationGuru::where('user_id', Auth::id())->findOrFail($id);
        $notif->update(['is_read' => true]);
    
        return redirect($notif->link ?? '/dashboard');
    }
    
}
