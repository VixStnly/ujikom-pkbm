<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Subject;
use App\Models\Meeting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;


class MateriController extends Controller
{
    // Menampilkan semua materi yang telah diunggah oleh guru
    public function index(Request $request)
    {
        $this->authorizeAccess(); // Memeriksa akses

        $user = Auth::user(); // Ambil data pengguna yang sedang login

        $userId = auth()->id();



        $enrolledSubjects = Subject::whereHas('users', function ($query) {
            $query->where('user_id', auth()->id());
        })->paginate(4);

        $meetings = Meeting::whereIn('subject_id', $enrolledSubjects->pluck('id'))
            ->with(['materi', 'tugas'])
            ->get();

        // Get selected meeting id from the request
        $selectedMeetingId = $request->query('meeting_id');

        // Filter materials based on selected meeting id
        $materis = Materi::when($selectedMeetingId, function ($query) use ($selectedMeetingId) {
            return $query->where('meeting_id', $selectedMeetingId);
        })->paginate(10);

        // Mulai query untuk mengambil materi beserta relasi kelas, guru, dan subject
        $query = Materi::with(['kelas.subject', 'guru']) // Memuat relasi kelas dan subject
            ->where('user_id', $user->id);

        // Cek apakah ada filter meeting_id dalam request
        if ($request->filled('meeting_id')) {
            $query->where('meeting_id', $request->meeting_id);
        }

        // Cek apakah ada filter subject_id dalam request
        if ($request->filled('subject_id')) {
            $query->whereHas('kelas.subject', function ($q) use ($request) {
                $q->where('id', $request->subject_id);
            });
        }

        // Ambil data materi dengan relasi kelas, guru, dan subject
        $materis = $query->paginate(8); // Gunakan query yang telah difilter

        // Ambil semua data subject yang terkait dengan kelas berdasarkan meeting
        $subjects = Subject::whereIn('id', function ($query) use ($user) {
            $query->select('subject_id')
                ->from('meetings')
                ->where('user_id', $user->id);
        })->get();

        return view('guru.materi.index', compact('materis', 'user', 'meetings', 'subjects', 'selectedMeetingId', 'enrolledSubjects'));
    }

    public function pelajaran(Request $request)
    {
        $this->authorizeAccess(); // Memeriksa akses

        $user = Auth::user(); // Ambil data pengguna yang sedang login

        // Ambil semua pertemuan (meetings) berdasarkan subject yang terkait dengan user yang login
        $meetings = Meeting::whereHas('subject', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['materi', 'tugas'])->get();

        // Ambil ID meeting yang dipilih dari permintaan (request)
        $selectedMeetingId = $request->query('meeting_id');

        // Query untuk materi (materis) yang terkait dengan user yang login
        $materisQuery = Materi::with(['kelas.subject', 'guru'])
            ->whereHas('meeting.subject', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });

        // Filter materi berdasarkan meeting_id jika ada
        if ($selectedMeetingId) {
            $materisQuery->where('meeting_id', $selectedMeetingId);
        }

        // Filter materi berdasarkan subject_id jika ada dalam request
        if ($request->filled('subject_id')) {
            $materisQuery->whereHas('kelas.subject', function ($q) use ($request) {
                $q->where('id', $request->subject_id);
            });
        }

        // Ambil data materi dengan filter dan relasi yang ditentukan
        $materis = $materisQuery->paginate(8);

        // Ambil semua subject yang terkait dengan kelas dan meeting dari user yang sedang login
        $subjects = Subject::where('user_id', $user->id)->paginate(6);

        return view('guru.materi.pelajaran', compact('materis', 'user', 'meetings', 'subjects', 'selectedMeetingId'));
    }



    // app/Http/Controllers/MateriController.php
    public function show($id)
    {
        $this->authorizeAccess(); // Memeriksa akses

        $user = Auth::user(); // Ambil data pengguna yang sedang login
        $materi = Materi::findOrFail($id);
        return view('guru.materi.show', compact('materi', 'user', ));
    }

    public function createM($meeting_id)
    {
        $this->authorizeAccess(); // Memeriksa akses

        $user = Auth::user(); // Ambil data pengguna yang sedang login
        // Ambil semua meeting yang terkait dengan user saat ini (opsional)
        $meetings = Meeting::where('user_id', auth()->id())->get();

        // Ambil meeting spesifik berdasarkan meeting_id
        $meeting = Meeting::findOrFail($meeting_id);

        // Ambil subject yang terkait dengan meeting
        $subject = $meeting->subject;  // Ambil subject terkait dengan meeting

        // Kirimkan data meeting dan subject ke view untuk createMateri
        return view('guru.materi.createM', compact('meetings', 'meeting', 'subject', 'user'));
    }


    // Form untuk menambah materi baru
    public function create()
    {
        $this->authorizeAccess(); // Memeriksa akses

        $user = Auth::user(); // Ambil data pengguna yang sedang login
        $meetings = Meeting::where('user_id', auth()->id())->get(); // Ambil dari id dari database
        return view('guru.materi.create', compact('meetings', 'user')); // Kirim data kursus ke view
    }

    // Menyimpan materi ke database
    public function store(Request $request)
    {
        $this->authorizeAccess(); // Memeriksa akses

        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'file' => 'nullable|file|mimes:zip,xlsx,rar,pdf,docx,pptx,png,jpg,jpeg,mp4,mov,avi|max:20480',
            'link' => 'nullable|url',
            'meeting_id' => 'required|exists:meetings,id',
        ]);

        // Proses penyimpanan file jika ada
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('materi_files', 'public');
            $validatedData['file_path'] = $filePath;
        } else {
            $validatedData['file_path'] = null; // Set null jika file tidak ada
        }

        // Jika tidak ada link, tetap set ke null
        $validatedData['link'] = $request->link ?? null;

        $validatedData['user_id'] = auth()->id();

        // Simpan materi ke database
        Materi::create($validatedData);

        // Arahkan ke halaman materi berdasarkan ID meeting
        return redirect()->route('guru.materi.index', ['meeting_id' => $validatedData['meeting_id']])
            ->with('success', 'Materi berhasil ditambahkan');
    }

    // Menampilkan formulir untuk mengedit materi
    public function edit(Materi $materi)
    {
        $this->authorizeAccess(); // Memeriksa akses

        $user = Auth::user(); // Ambil data pengguna yang sedang login
        $meetings = Meeting::where('user_id', auth()->id())->get(); // Ambil dari id dari database
        return view('guru.materi.edit', compact('materi', 'meetings', 'user')); // Kirim data materi dan kursus ke view
    }

    // Memperbarui materi di database
    public function update(Request $request, Materi $materi)
    {
        $this->authorizeAccess(); // Memeriksa akses

        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'file' => 'nullable|file|mimes:zip,xlsx,rar,pdf,docx,pptx,png,jpg,jpeg|max:20480',
            'link' => 'nullable|url',
            'meeting_id' => 'required|exists:meetings,id',
        ]);

        // Ambil file yang sudah ada sebelumnya
        $filePath = $materi->file_path;

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($filePath) {
                Storage::delete('public/' . $filePath);
            }

            $file = $request->file('file');
            $filePath = $file->store('materi_files', 'public');
        }

        // Perbarui data tugas
        $validatedData = $request->all();
        $validatedData['file_path'] = $filePath; // Tetap gunakan file lama jika tidak ada file baru
        $validatedData['link'] = $request->link ?? $materi->link; // Simpan link lama jika tidak ada yang baru

        $materi->update($validatedData);

        return redirect()->route('guru.materi.index', ['meeting_id' => $validatedData['meeting_id']])
            ->with('success', 'Materi berhasil diedit');
    }

    // Menghapus materi
    public function destroy(Materi $materi)
    {
        $this->authorizeAccess();

        if ($materi->user_id === auth()->id()) {
            $meetingId = $materi->meeting_id; // Ambil meeting_id sebelum materi dihapus

            // Hapus file yang terkait jika ada
            if ($materi->file_path) {
                Storage::delete('public/' . $materi->file_path);
            }

            $materi->delete();

            // Redirect ke halaman index materi dengan meeting_id terkait
            return redirect()->route('guru.materi.index', ['meeting_id' => $meetingId])
                ->with('success', 'Materi berhasil dihapus');
        }

        return redirect()->back()->with('error', 'Anda tidak diizinkan menghapus materi ini');
    }


    protected function authorizeAccess()
    {
        $user = Auth::user();

        // Memeriksa apakah pengguna memiliki role_id 1 atau 2
        if (!$user || !in_array($user->role_id, [3])) {
            throw new HttpResponseException(response()->json([
                'error' => 'Unauthorized access'
            ], 403));
        }
    }
}