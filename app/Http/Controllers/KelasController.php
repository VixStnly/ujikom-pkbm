<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Absensi;
use App\Models\Subject;
use App\Models\Tugas;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $this->authorizeAccess(); // Memeriksa akses

        $kelas = Kelas::paginate(10);
        return view('admin.kelas.index', compact('kelas', 'user'));
    }

    // Guru
    public function indexGuru()
    {
        $this->authorizeAccess(); // Memeriksa akses

        $guruId = auth()->user()->id; // Ambil ID guru yang sedang login
        $user = Auth::user(); // Ambil data pengguna yang sedang login

        $userId = auth()->id();
        

        // Ambil kelas yang diajarkan oleh guru ini
        $kelas = Kelas::whereHas('users', function ($query) use ($guruId) {
            $query->where('user_id', $guruId);
        })
            ->with([
                'users' => function ($query) {
                    $query->whereHas('role', fn($q) => $q->where('name', 'siswa'));
                }
            ])
            ->paginate(3);

        // Ambil pertemuan (meeting) yang dibuat oleh guru ini
        $meetingId = Meeting::where('user_id', $guruId)->latest()->first();

        // Tambahkan atribut jumlah siswa ke setiap kelas
        foreach ($kelas as $kelasItem) {
            $kelasItem->jumlah_siswa = $kelasItem->users->count();
        }

        // Ambil mata pelajaran yang diikuti oleh guru
        $enrolledSubjects = Auth::user()->enrolledSubjects()->orderBy('kelas_id', 'asc')->paginate(6);

        // Ambil semua subject yang terkait dengan kelas berdasarkan meeting
        $subjects = Subject::whereIn('id', function ($query) use ($user) {
            $query->select('subject_id')
                ->from('meetings')
                ->where('user_id', $user->id);
        })->get();



        // $results = DB::table('kelas')
        //     ->join('kelas_user', 'kelas.id', 'kelas_user.kelas_id') // Menggabungkan tabel 'users' dengan 'posts' berdasarkan 'user_id'
        //     ->where('kelas_user.user_id', 8) // Menambahkan kondisi where untuk user dengan id 1
        //     ->select('kelas_user.*', 'kelas.name') // Memilih kolom yang diinginkan
        //     ->get();


        return view('guru.kelas.index', compact('kelas', 'meetingId', 'user', 'subjects', 'enrolledSubjects'));
    }

    public function subject($kelasId)
    {
        $this->authorizeAccess();
        $user = Auth::user(); // Ambil data pengguna yang sedang login
        $userId = $user->id;

        $kelas = Kelas::findOrFail($kelasId);
        $subjects = $kelas->subjects; // Asumsikan kelas memiliki relasi 'subjects'
        $subjects = $kelas->subjects()->where('user_id', $userId)->paginate(6); // Asumsikan kelas memiliki relasi 'subjects'

        return view('guru.kelas.pelajaran', compact('user','kelas', 'subjects'));
    }

    public function showMeeting($kelasId, $subjectId)
    {
        $this->authorizeAccess();

        $user = Auth::user(); // Ambil data pengguna yang sedang login
        $userId = $user->id;

        $kelas = Kelas::findOrFail($kelasId);
        $subject = Subject::findOrFail($subjectId);
        $meetings = $subject->meetings; // Mengambil semua pertemuan terkait subject
        $meetings = $subject->meetings()->where('user_id', $userId)->paginate(6); // Asumsikan kelas memiliki relasi 'subjects'


        return view('guru.kelas.meeting', compact('user','kelas', 'subject', 'meetings'));
    }



    public function showSiswa(Kelas $kelas, $meetingId)
    {
        $this->authorizeAccess(); // Memeriksa akses

        $user = Auth::user(); // Ambil data pengguna yang sedang login

        $userId = auth()->id();
        $meeting = Meeting::findOrFail($meetingId);
        $siswa = $kelas->users()->whereHas('role', fn($query) => $query->where('name', 'siswa'))
            ->with(['absensi' => fn($query) => $query->where('meeting_id', $meetingId)])
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('guru.kelas.siswa', compact('kelas', 'siswa', 'meetingId', 'meeting', 'user'));
    }

    

    public function showGuru($subjectId)
    {
        $kelas = Kelas::where('subject_id', $subjectId)->first();
        $meetings = Meeting::where('subject_id', $subjectId)->paginate(10);

        return view('guru.meeting.show', compact('kelas', 'meetings'));
    }

    public function pelajaran(Request $request)
    {
        $this->authorizeAccess();

        $user = Auth::user(); // Ambil data pengguna yang sedang login

        $userId = auth()->id();
        $enrolledSubjects = Auth::user()->enrolledSubjects()->orderBy('kelas_id', 'asc')->paginate(6);

        $subjects = Subject::whereIn('id', function ($query) use ($user) {
            $query->select('subject_id')->from('meetings')->where('user_id', $user->id);
        })->get();

        $meetings = Meeting::whereIn('subject_id', $enrolledSubjects->pluck('id'))
            ->with(['materi', 'tugas'])
            ->get();

        return view('guru.kelas.pelajaran', compact('user', 'subjects', 'meetings', 'enrolledSubjects'));
    }

    //end Guru

    public function create()
    {
        $this->authorizeAccess(); // Memeriksa akses
        $user = Auth::user(); // Ambil data pengguna yang sedang login

        $userId = auth()->id();

        return view('admin.kelas.create', compact('user'));
    }

    public function store(Request $request)
    {
        $this->authorizeAccess(); // Memeriksa akses

        // Definisikan aturan validasi dengan pesan
        $request->validate([
            'grade' => 'required|string|max:5',
            'name' => 'required|string|max:55',
        ], [
            'grade.required' => 'Tingkatan harus diisi.',
            'grade.string' => 'Tingkatan harus berupa teks.',
            'grade.max' => 'Tingatan tidak boleh lebih dari 100 karakter.',
            'name.required' => 'Nama harus diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
        ]);

        // Simpan data kelas yang baru dibuat
        Kelas::create([
            'grade' => $request->input('grade'), // Mengambil nilai grade dari request
            'name' => $request->input('name'),   // Mengambil nilai name dari request
        ]);

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil dibuat.');
    }

    public function show(Kelas $kelas)
    {
        $this->authorizeAccess(); // Memeriksa akses

        return view('admin.kelas.show', compact('kelas'));
    }

    public function edit(Kelas $kelas)
    {
        $this->authorizeAccess(); // Memeriksa akses
        $user = Auth::user(); // Ambil data pengguna yang sedang login

        $userId = auth()->id();

        return view('admin.kelas.edit', compact('kelas', 'user'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $this->authorizeAccess(); // Memeriksa akses

        // Definisikan aturan validasi dengan pesan
        $request->validate([
            'grade' => 'required|string|max:10',
            'name' => 'required|string|max:55',
        ], [
            'grade.required' => 'Tingkatan harus diisi.',
            'grade.string' => 'Tingkatan harus berupa teks.',
            'grade.max' => 'Tingkatan tidak boleh lebih dari 10 karakter.',
            'name.required' => 'Nama harus diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari 55 karakter.',
        ]);

        $kelas->update($request->only(['grade', 'name']));
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kelas)
    {
        $this->authorizeAccess(); // Memeriksa akses

        $kelas->delete();
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }

    protected function authorizeAccess()
    {
        $user = Auth::user();

        // Memeriksa apakah pengguna memiliki role_id 1 atau 2
        if (!$user || !in_array($user->role_id, [1, 3])) {
            throw new HttpResponseException(response()->json([
                'error' => 'Unauthorized access'
            ], 403));
        }
    }
}
