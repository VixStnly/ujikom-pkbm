<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use App\Models\Meeting;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;

class MeetingController extends Controller
{
    public function show(Meeting $meeting)
    {
        $this->authorizeAccess();

        // Hanya ambil tugas dan materi yang terkait dengan meeting dan user yang sedang login
        $tugass = $meeting->tugass()->where('user_id', auth()->id())->get();
        $materis = $meeting->materis()->where('user_id', auth()->id())->get();

        // Ambil subject yang terkait dengan meeting ini
        $subjects = $meeting->subject;

        return view('guru.meeting.index', compact('meeting', 'tugass', 'materis', 'subjects'));
    }

    public function showMeetings($subject_id)
    {
        $this->authorizeAccess(); // Memeriksa akses

        // Dapatkan subject yang spesifik
        $subject = Subject::findOrFail($subject_id);
        $user = Auth::user(); // Ambil data pengguna yang sedang login

        // Dapatkan meetings terkait dengan subject ini dan filter tugas dan materi berdasarkan user
        $meetings = Meeting::where('subject_id', $subject_id)
            ->with([
                'materi' => function ($query) {
                    $query->where('user_id', auth()->id()); // Filter materi berdasarkan user
                },
                'tugas' => function ($query) {
                    $query->where('user_id', auth()->id()); // Filter tugas berdasarkan user
                },
                'absensi' // Load absensi relationship
            ])
            ->get();
        $subject = Subject::findOrFail($subject_id); // Menggunakan subject_id
        $meetings = $subject->meetings; // Ambil pertemuan yang terkait dengan pelajaran ini
        // Check if today matches any meeting date
        $today = now()->toDateString(); // Get today's date
        $isToday = []; // Initialize the array to store meeting IDs that are today
        $isUpcoming = []; // Initialize the array to store upcoming meeting IDs

        foreach ($meetings as $meeting) {
            // Check if the meeting date is not null before accessing it
            if ($meeting->date) {
                if ($meeting->date->toDateString() === $today) {
                    $isToday[] = $meeting->id; // Store meeting ID if it's today
                }

                if ($meeting->date > now()) {
                    $isUpcoming[] = $meeting->id; // Store meeting ID if it's upcoming
                }
            }
        }

        // Pass the subject, meetings, user, isToday, and isUpcoming to the view
        return view('meetings.index', compact('subject', 'meetings', 'user', 'isToday', 'isUpcoming'));
    }

    public function index()
    {
        $this->authorizeAccess();

        $user = Auth::user();

        // Ambil semua meetings yang terkait dengan subjects yang dimiliki user dengan paginasi
        $meetings = Meeting::whereHas('subject', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['materi', 'tugas'])->paginate(10);
        $subjects = Subject::where('user_id', $user->id)->paginate(6);

        return view('guru.meeting.index', compact('meetings', 'user', 'subjects'));
    }

    public function create()
    {
        $this->authorizeAccess();

        $user = Auth::user();
        // Ambil subjects yang dimiliki user
        $subjects = Subject::where('user_id', $user->id)->get();

        return view('guru.meeting.create', compact('subjects', 'user'));
    }

    public function createS($subject_id)
    {
        $this->authorizeAccess();

        $user = Auth::user();
        // Ambil semua meeting yang terkait dengan user saat ini
        $meetings = Meeting::where('user_id', auth()->id())->get();
        $subjects = Subject::find($subject_id);

        return view('guru.meeting.createS', compact('meetings', 'subjects', 'user'));
    }
    
public function store(Request $request)
{
    $this->authorizeAccess();

    $request->validate([
        'subject_id' => 'required',
        'title' => 'required|string|max:255',
        'meeting_time' => 'required|date',
        'description' => 'nullable|string',
    ]);

    $data = $request->all();
    $data['user_id'] = auth()->id();

    $meeting = Meeting::create($data);

        Notification::create([
            'user_id' => null,
            'message' => auth()->user()->name . ' membuat pertemuan baru: ' . $meeting->title,
            'icon' => 'group_add',
            'icon_color' => 'primary',
        ]);

    return redirect()->route('guru.meeting.index')->with('success', 'Pertemuan berhasil dibuat.');
}
    

    public function edit(Meeting $meeting)
    {
        $this->authorizeAccess();

        $user = Auth::user();
        // Ambil subjects yang dimiliki user
        $subjects = Subject::where('user_id', $user->id)->get();

        return view('guru.meeting.edit', compact('meeting', 'user', 'subjects'));
    }

    public function update(Request $request, Meeting $meeting)
    {
        $this->authorizeAccess();

        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'meeting_time' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();
        $meeting->update($data);

        return redirect()->route('guru.meeting.index')->with('success', 'Pertemuan berhasil diperbarui.');
    }

    public function destroy(Meeting $meeting)
    {
        $this->authorizeAccess();

        $meeting->delete();
        return redirect()->route('guru.meeting.index')->with('success', 'Pertemuan berhasil dihapus.');
    }

    public function getMeetings($subjectId)
    {
        // Menarik data pertemuan berdasarkan subject_id
        $meetings = Meeting::where('subject_id', $subjectId)->get();

        // Memastikan data dikembalikan dalam format JSON
        return response()->json($meetings);

        if ($meetings->isEmpty()) {
            return response()->json(['message' => 'No meetings found'], 404);
        }
    }


    protected function authorizeAccess()
    {
        $user = Auth::user();

        // Memeriksa apakah pengguna memiliki role_id 4 atau 3
        if (!$user || !in_array($user->role_id, [4, 3])) {
            throw new HttpResponseException(response()->json([
                'error' => 'Unauthorized access'
            ], 403));
        }
    }
}