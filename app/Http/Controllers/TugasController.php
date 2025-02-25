<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Tugas;
use App\Models\Subject;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;

class TugasController extends Controller
{
    // Menampilkan semua tugas
    public function index(Request $request)
    {
        $this->authorizeAccess(); // Memeriksa akses

        $user = Auth::user(); // Ambil data pengguna yang sedang login

        // Ambil meeting_id dari query parameter jika ada
        $meetingId = $request->get('meeting_id');

        // Hanya tugas dari guru yang sedang login
        $query = Tugas::where('user_id', auth()->id());

        // Jika meeting_id tersedia, tambahkan filter
        if ($meetingId) {
            $query->where('meeting_id', $meetingId);
        }

        // Ambil tugas beserta jumlah siswa yang sudah mengumpulkan dan relasi meeting dan subject
        $tugass = $query->withCount('submissions')
            ->with(['meeting.subject']) // Include meeting and its subject
            ->paginate(4); // Mengambil tugas beserta jumlah pengumpulan

        return view('guru.tugas.index', compact('tugass', 'user', 'meetingId'));
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

        // Query untuk tugas (tugas) yang terkait dengan user yang login
        $tugasQuery = Tugas::with(['meeting.subject', 'guru'])
            ->where('user_id', auth()->id());

        // Filter tugas berdasarkan meeting_id jika ada
        if ($selectedMeetingId) {
            $tugasQuery->where('meeting_id', $selectedMeetingId);
        }

        // Ambil data tugas dengan filter dan relasi yang ditentukan
        $tugas = $tugasQuery->paginate(8);

        // Ambil semua subject yang terkait dengan kelas dari user yang sedang login
        $subjects = Subject::where('user_id', $user->id)->paginate(6);

        return view('guru.tugas.pelajaran', compact('tugas', 'user', 'meetings', 'subjects', 'selectedMeetingId'));
    }

    // Form tambah tugas baru
    public function createM($meeting_id)
    {
        $this->authorizeAccess(); // Memeriksa akses

        $user = Auth::user(); // Ambil data pengguna yang sedang login

        $user = Auth::user(); // Ambil data pengguna yang sedang login

        // Ambil semua meeting yang terkait dengan user saat ini (optional jika diperlukan)
        $meetings = Meeting::where('user_id', auth()->id())->get();

        // Ambil meeting spesifik berdasarkan meeting_id
        $meeting = Meeting::findOrFail($meeting_id);

        // Ambil subject yang terkait dengan meeting (pastikan meeting memiliki relasi dengan subject)
        $subject = $meeting->subject;  // Ambil subjek terkait dengan meeting

        // Kirimkan data meeting dan subject ke view
        return view('guru.tugas.createM', compact('meetings', 'meeting', 'subject', 'user'));
    }



    public function create(Meeting $meeting)
    {
        $this->authorizeAccess(); // Memeriksa akses

        $user = Auth::user(); // Ambil data pengguna yang sedang login

        $user = Auth::user(); // Ambil data pengguna yang sedang login

        // Ambil semua meeting yang terkait dengan user saat ini

        $meetings = Meeting::where('user_id', auth()->id())->get();
        // Kirimkan data meeting dan daftar meetings ke view
        return view('guru.tugas.create', compact('meetings', 'user'));
    }


    // Menyimpan tugas ke database  
    public function store(Request $request)
    {
        $this->authorizeAccess(); // Memeriksa akses

        \Log::info('Data yang diterima:', $request->all());

        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_deadline' => 'required|date',
            'file' => 'nullable|file|mimes:pdf,docx,pptx,png,jpg,jpeg|max:20480',
            'link' => 'nullable|url',
            'meeting_id' => 'required|exists:meetings,id', // Validasi kelas_id
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('tugas_files', 'public');
            $validatedData['file_path'] = $filePath;
        }

        $validatedData['user_id'] = auth()->id();

        \DB::enableQueryLog(); // Aktifkan query log
        Tugas::create($validatedData);
        \Log::info('Query yang dijalankan:', \DB::getQueryLog());

        return redirect()->route('guru.tugas.index', ['meeting_id' => $validatedData['meeting_id']])
            ->with('success', 'Tugas berhasil ditambahkan');
    }




    // Form edit tugas
    public function edit(Tugas $tugas)
    {
        $this->authorizeAccess(); // Memeriksa akses

        $user = Auth::user(); // Ambil data pengguna yang sedang login

        $subjects = Subject::all(); // Ambil semua kursus dari database
        $meetings = Meeting::all(); // Ambil semua kelas dari database
        return view('guru.tugas.edit', compact('tugas', 'subjects', 'meetings', 'user'));
    }

    // Mengupdate tugas
    public function update(Request $request, Tugas $tugas)
    {
        $this->authorizeAccess(); // Memeriksa akses

        // Validasi data yang diterima
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_deadline' => 'required|date',
            'file' => 'nullable|file|mimes:pdf,doc,docx,pptx,png,jpg,jpeg|max:20480',
            'link' => 'nullable|url',
            'meeting_id' => 'required|exists:meetings,id', // Validasi meeting_id
        ]);

        // Cek apakah ada file yang di-upload
        if ($request->hasFile('file')) {
            // Jika ada file lama, hapus dulu dari storage
            if ($tugas->file_path && \Storage::exists('public/' . $tugas->file_path)) {
                \Storage::delete('public/' . $tugas->file_path);
            }

            // Simpan file baru dan perbarui $validatedData dengan file path
            $file = $request->file('file');
            $filePath = $file->store('tugas_files', 'public');
            $validatedData['file_path'] = $filePath;
        }

        // Perbarui data tugas dengan data yang telah divalidasi
        $tugas->update($validatedData);

        return redirect()->route('guru.tugas.index', ['meeting_id' => $validatedData['meeting_id']])
            ->with('success', 'Tugas berhasil diedit');
    }


    // Menghapus tugas
    public function destroy(Tugas $tugas)
    {
        $this->authorizeAccess(); // Memeriksa akses

        // Pastikan hanya guru yang menambahkan tugas yang dapat menghapusnya
        if ($tugas->user_id === auth()->id()) {
            $meetingId = $tugas->meeting_id; // Ambil meeting_id sebelum materi dihapus
            // Hapus file terkait jika ada
            if ($tugas->file) {
                Storage::delete('public/' . $tugas->file);
            }

            $tugas->delete();
            return redirect()->route('guru.tugas.index', ['meeting_id' => $meetingId])
                ->with('success', 'Tugas berhasil dihapus');
        }

        return redirect()->back()->with('error', 'Anda tidak diizinkan menghapus tugas ini');
    }

    // submissions Tugas
    public function reviewTugas($id)
    {
        $this->authorizeAccess(); // Memeriksa akses

        $user = Auth::user(); // Ambil data pengguna yang sedang login

        // Ambil tugas berdasarkan ID
        $tugas = Tugas::with('submissionsTugas.siswa', 'submissionsTugas.score')->find($id);

        // Mem-paginate submissions tugas, misal 10 per halaman
        $submissions = $tugas->submissionsTugas()->with('siswa', 'score')->paginate(10);

        // Mengelompokkan submissions berdasarkan tugas
        $ungradedSubmissions = $submissions->groupBy('tugas_id');

        return view('guru.tugas.review', compact('tugas', 'submissions', 'ungradedSubmissions', 'user')); // Menampilkan halaman review
    }



    public function storeOrUpdateScore(Request $request, $submissionId)
    {
        $this->authorizeAccess(); // Memeriksa akses

        $validated = $request->validate([
            'nilai' => 'required|numeric|min:0|max:100',
            'keterangan' => 'nullable|string',
        ]);

        $submission = Submission::find($submissionId);

        if ($submission) {
            $submission->score()->updateOrCreate(
                ['submission_id' => $submission->id], // Field untuk menemukan record
                [
                    'nilai' => $validated['nilai'],
                    'keterangan' => $validated['keterangan'],
                    'user_id' => auth()->id(), // Menambahkan user_id
                ]
            );

            // Menyimpan pesan sukses ke dalam session
            return redirect()->route('guru.tugas.review', $submission->tugas_id)
                ->with('success', 'Nilai berhasil disimpan.');
        }

        return redirect()->route('guru.tugas.review', $submission->tugas_id)
            ->with('error', 'Submission tidak ditemukan.');
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