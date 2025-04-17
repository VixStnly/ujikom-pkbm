<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\User;
use App\Models\Meeting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ForumController extends Controller
{
    public function index($meetingId) {
        $user = Auth::user();

        $meeting = Meeting::findOrFail($meetingId);
        $forums = Forum::where('meeting_id', $meetingId)->with('user')->latest()->get();
        return view('forums.index', compact('forums', 'meeting','user'));
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
            'parent_id' => $request->input('parent_id'), // <- penting!
        ];
    
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('forum', 'public');
        }
    
        Forum::create($data);
    
        return back()->with('success', 'Pesan berhasil dikirim');
    }
    
    
}
