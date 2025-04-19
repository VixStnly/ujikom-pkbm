<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Absensi;
use App\Models\Tugas;
use App\Models\Kelas;
use App\Models\Meeting;
use App\Models\Subject;
use App\Models\Score;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HistoriController extends Controller
{
    public function absen()
    {
        $user = Auth::user();

        // Mengambil data absensi pengguna yang sedang login, serta informasi meeting yang terkait
        $absensi = Absensi::with('meeting')
            ->where('user_id', $user->id)
            ->orderBy('tanggal_absen', 'desc') // Mengurutkan berdasarkan tanggal_absen dari yang terbaru
            ->get();

        // Mengirim data user dan absensi ke view
        return view('histori.absen', compact('user', 'absensi'));
    }

    public function tugas()
    {
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login

        // Mengambil subjects yang dimiliki oleh user
        $subjects = $user->subjects()->pluck('subjects.id'); // Tambahkan nama tabel 'subjects' untuk menghindari ambiguitas

        // Mengambil submissions yang sesuai dengan subjects yang dimiliki user
        $submissions = Submission::with(['tugas.meeting.subject'])
            ->where('user_id', $user->id)
            ->whereHas('tugas.meeting.subject', function ($query) use ($subjects) {
                $query->whereIn('subjects.id', $subjects); // Menggunakan 'subjects.id' untuk menghindari ambiguitas
            })
            ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan created_at dari yang terbaru
            ->get();

        // Mengambil semua tugas berdasarkan subject yang dimiliki user dan mengurutkan berdasarkan status
        $tugas = Tugas::whereHas('meeting.subject', function ($query) use ($subjects) {
            $query->whereIn('subjects.id', $subjects); // Menggunakan 'subjects.id' untuk menghindari ambiguitas
        })->get()
            ->sortBy(function ($task) use ($user) {
                return $task->submissions()->where('user_id', $user->id)->exists() ? 1 : 0; // 0 untuk tidak dikerjakan, 1 untuk dikerjakan
            });

        // Mengirim data user dan submissions ke view
        return view('histori.tugas', compact('user', 'submissions', 'tugas'));
    }





    //guru
    public function index()
    {
        $user = Auth::user(); // Ambil data pengguna yang sedang login
        $guruId = session('view_as_guru_id', Auth::id()); // Pakai ID guru impersonate jika ada

        // Ambil kelas berdasarkan guru yang sedang login
        $kelas = Kelas::whereHas('users', function ($query) use ($guruId) {
            $query->where('user_id', $guruId);
        })
            ->with([
                'users' => function ($query) {
                    $query->whereHas('role', fn($q) => $q->where('name', 'siswa'));
                }
            ])
            ->paginate(3); // Paginasi kelas

        return view('guru.history.index', compact('kelas', 'user'));
    }

    public function history($kelasId)
    {

        $user = Auth::user(); // Ambil data pengguna yang sedang login

        // Ambil semua siswa dalam kelas dengan ID tertentu
        $students = User::whereHas('kelas', function ($query) use ($kelasId) {
            $query->where('kelas.id', $kelasId); // Spesifikasikan tabel 'kelas'
        })
            ->where('role_id', 4) // hanya ambil siswa
            ->with(['tugas.meeting.subject']) // Load relasi tugas, meeting, dan subject
            ->paginate(10); // Atur pagination

        // Siapkan data riwayat untuk masing-masing siswa
        $historyData = [];
        foreach ($students as $student) {
            $tugas = $student->tugas;
            $studentHistory = [];

            // Kelompokkan tugas berdasarkan subject untuk riwayat
            if ($tugas->isNotEmpty()) {
                foreach ($tugas->groupBy('meeting.subject.id') as $subjectId => $tugasGroup) {
                    $subject = Subject::find($subjectId);

                    $meetingHistories = [];
                    foreach ($tugasGroup->groupBy('meeting.id') as $meetingId => $meetingTugas) {
                        $meeting = Meeting::find($meetingId);
                        $meetingHistories[] = [
                            'meeting' => $meeting->name,
                            'scores' => $meetingTugas->pluck('score'), // ambil semua skor tugas untuk riwayat
                        ];
                    }

                    $studentHistory[] = [
                        'subject' => $subject->name,
                        'meetings' => $meetingHistories,
                    ];
                }
            }

            $historyData[$student->id] = [
                'student' => $student,
                'history' => $studentHistory,
            ];
        }

        return view('guru.history.siswa', [
            'students' => $students,
            'historyData' => $historyData,
            'kelasId' => $kelasId, // Pastikan kelasId juga dikirim ke view
            'user' => $user,
        ]);
    }


    public function indexH($studentId, $kelasId)
    {
        $user = Auth::user(); // User yang login (admin atau guru)
        $guruId = session('view_as_guru_id', $user->id); // Ambil ID guru dari session jika impersonate
    
        // Ambil data nilai untuk siswa yang dipilih dan dinilai oleh guru tersebut
        $historyData = Score::whereHas('submission', function ($query) use ($guruId, $studentId) {
            $query->where('user_id', $studentId) // Hanya ambil data untuk siswa yang dipilih
                ->whereHas('tugas.meeting', function ($query) use ($guruId) {
                    // Filter tugas berdasarkan guru yang mengajar
                    $query->where('user_id', $guruId);
                });
        })
            ->with(['submission.tugas.meeting.subject']) // Tambahkan relasi untuk memuat data yang dibutuhkan
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    
        $student = User::find($studentId);
    
        return view('guru.history.siswa.index', compact('historyData', 'user', 'student', 'kelasId'));
    }
    


}
