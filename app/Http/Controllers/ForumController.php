<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\User;
use App\Models\Activity;
use App\Models\Meeting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ForumController extends Controller
{
    public function index($meetingId) {
        $user = Auth::user();
        $meeting = Meeting::findOrFail($meetingId);
        $forums = Forum::where('meeting_id', $meetingId)->with('user')->latest()->get();
    
        $activities = Activity::whereIn('user_id', $forums->pluck('user_id'))
                        ->latest()
                        ->take(4)
                        ->with('user')
                        ->get();
    
        return view('forums.index', compact('forums', 'meeting', 'user', 'activities'));
    }

    public function store(Request $request, $meetingId) {
        $request->validate([
            'message' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);
    
        $data = [
            'meeting_id' => $meetingId,
            'user_id' => Auth::id(),
            'message' => $request->message,
            'parent_id' => $request->input('parent_id'),
        ];
    
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('forum', 'public');
        }
    
        $forum = Forum::create($data)->load('user'); // FIXED: penting agar blade bisa akses $forum->user
    
        // Tambahkan aktivitas jika itu pertanyaan utama (bukan reply)
        if (!empty($request->message) && !$request->filled('parent_id')) {
            Activity::create([
                'user_id' => Auth::id(),
                'message' => 'Menambahkan Pertanyaan baru: "' . $request->message . '"',
            ]);
        }

        if ($request->ajax()) {
            logger('AJAX store jalan!');
            return response()->json([
                'message' => 'Balasan berhasil dikirim!',
                'reply' => view('content.buble-chat', compact('forum'))->render(),
            ]);
        }
        
    
        return back()->with('success', 'Pesan berhasil dikirim');
    }

    public function like($id)
    {
        $forum = Forum::findOrFail($id);
        $user = Auth::user();
        $liked = false;
    
        if ($forum->likes()->where('user_id', $user->id)->exists()) {
            $forum->likes()->detach($user->id);
    
            Activity::where('user_id', $user->id)
                ->where('message', 'like', '%Menyukai pertanyaan: "' . $forum->message . '"%')
                ->delete();
        } else {
            $forum->likes()->attach($user->id);
            $liked = true;
    
            Activity::create([
                'user_id' => $user->id,
                'message' => 'Menyukai pertanyaan: "' . $forum->message . '"',
            ]);
        }
    
        return response()->json([
            'liked' => $liked,
            'like_count' => $forum->likes()->count(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $forum = Forum::findOrFail($id);
        $forum->message = $request->message;
        $forum->meeting_id = $request->meeting_id;
        $forum->save();
    
        return redirect()->back()->with('success', 'Judul forum berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $forum = Forum::with('replies')->findOrFail($id);
    
        if ($forum->image_path) {
            Storage::disk('public')->delete($forum->image_path);
        }
    
        foreach ($forum->replies as $reply) {
            if ($reply->image_path) {
                Storage::disk('public')->delete($reply->image_path);
            }
            $reply->delete();
        }

        // Hapus aktivitas LIKE & POST terkait
        Activity::where('message', 'like', '%"' . $forum->message . '"%')->delete();
        Activity::where('message', 'Menambahkan Pertanyaan baru: "' . $forum->message . '"')->delete();
    
        $forum->delete();
    
        return redirect()->back()->with('success', 'Forum dan balasan berhasil dihapus.');
    }
}
