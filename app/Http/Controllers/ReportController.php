<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use App\Models\Tugas;
use App\Models\Kelas;
use App\Models\Report;
use App\Models\Meeting;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{


public function exportPdf($studentId, $kelasId)
{
    $student = User::findOrFail($studentId);
    $reports = Report::where('student_id', $studentId)
        ->join('meetings', 'meetings.id', '=', 'reports.meeting')
        ->with('subject', 'teacher')
        ->select('reports.*', 'meetings.title as meeting_title')
        ->orderBy('reports.meeting')
        ->get();

    $pdf = Pdf::loadView('guru.reports.laporan.pdf', compact('student', 'reports', 'kelasId'));
    return $pdf->download('raport_' . $student->name . '.pdf');
}

    
    public function index()
    {
        $this->authorizeAccess(); // Memeriksa akses
    
        $user = Auth::user(); // Data user yang login
        $guruId = session('view_as_guru_id', Auth::id()); // Pakai ID guru impersonate jika ada
    
        // Ambil kelas berdasarkan guru yang sedang login atau dilihat
        $kelas = Kelas::whereHas('users', function ($query) use ($guruId) {
            $query->where('user_id', $guruId);
        })
        ->with([
            'users' => function ($query) {
                $query->whereHas('role', fn($q) => $q->where('name', 'siswa'));
            }
        ])
        ->paginate(3);
    
        return view('guru.reports.index', compact('kelas', 'user'));
    }
    

    public function report($kelasId)
    {
        $this->authorizeAccess(); // Memeriksa akses
        $user = Auth::user(); // Ambil data pengguna yang sedang login

        // Ambil semua siswa dalam kelas dengan ID tertentu
        // Ambil semua siswa dalam kelas dengan ID tertentu
        $students = User::whereHas('kelas', function ($query) use ($kelasId) {
            $query->where('kelas.id', $kelasId); // Spesifikasikan tabel 'kelas'
        })
            ->where('role_id', 4)  // hanya ambil siswa
            ->with(['tugas.meeting.subject']) // Load relasi tugas, meeting, dan subject
            ->paginate(10); // Atur pagination

        $subjects = Subject::where('kelas_id', $kelasId)
            ->where('user_id', $user->id)
            ->get();

        // Siapkan data laporan untuk masing-masing siswa
        $reportData = [];
        foreach ($students as $student) {
            $tugas = $student->tugas;
            $studentReport = [];

            // Kelompokkan tugas berdasarkan subject
            if ($tugas->isNotEmpty()) {
                foreach ($tugas->groupBy('meeting.subject.id') as $subjectId => $tugasGroup) {
                    $subject = Subject::find($subjectId);

                    $meetingScores = [];
                    foreach ($tugasGroup->groupBy('meeting.id') as $meetingId => $meetingTugas) {
                        $averageScore = $meetingTugas->avg('score');
                        $meeting = Meeting::find($meetingId);
                        $meetingScores[] = [
                            'meeting' => $meeting->name,
                            'average_score' => $averageScore,
                        ];
                    }

                    $studentReport[] = [
                        'subject' => $subject->name,
                        'meetings' => $meetingScores,
                    ];
                }
            }

            $reportData[$student->id] = [
                'student' => $student,
                'report' => $studentReport,
            ];
        }

        return view('guru.reports.siswa', [
            'students' => $students,
            'reportData' => $reportData,
            'kelasId' => $kelasId, // Pastikan kelasId juga dikirim ke view
            'user' => $user,
            'subjects' => $subjects,
        ]);
    }


    // Menampilkan daftar laporan tugas siswa dalam kelas tertentu
    // Menampilkan laporan detail seorang siswa tertentu
    public function indexL($studentId, $kelasId)
    {
        $this->authorizeAccess();
        $user = Auth::user();
        $student = User::findOrFail($studentId);

        // Ambil data laporan dengan join ke tabel meetings untuk mengambil title
        $reports = Report::where('student_id', $studentId)
            ->join('meetings', 'meetings.id', '=', 'reports.meeting') // Join dengan tabel meetings
            ->with('subject', 'teacher') // Ambil relasi subject dan teacher
            ->select('reports.*', 'meetings.title as meeting_title') // Pilih semua kolom dari reports dan title dari meetings
            ->orderBy('reports.meeting') // Atur berdasarkan meeting
            ->get();

        return view('guru.reports.laporan.index', compact('reports', 'user', 'student', 'kelasId'));
    }


    public function create($studentId, $kelasId)
    {
        $this->authorizeAccess(); // Memeriksa akses
        $user = Auth::user(); // Ambil data pengguna yang sedang login

        // Mengambil data mata pelajaran yang terkait dengan guru yang sedang login dan kelas tertentu
        $subjects = Subject::where('kelas_id', $kelasId)
            ->where('user_id', $user->id)
            ->get();

        // Mengambil pertemuan yang terkait dengan mata pelajaran pertama, jika ada
        $meetings = collect(); // Inisialisasi sebagai koleksi kosong

        if ($subjects->isNotEmpty()) {
            // Jika subject pertama dipilih
            $subject_id = $subjects->first()->id;
            $meetings = Meeting::where('subject_id', $subject_id)
                ->where('user_id', auth()->id()) // Pastikan pertemuan milik guru
                ->get();
        }

        // Mengambil daftar siswa
        $students = User::where('role_id', '4')->get(); // Misalkan role "student" mewakili siswa

        // Kirimkan studentId dan kelasId ke view
        return view('guru.reports.laporan.create', compact('subjects', 'students', 'user', 'meetings', 'studentId', 'kelasId'));
    }



    public function store(Request $request, $studentId, $kelasId)
    {
        try {
            $validatedData = $request->validate([
                'student_id' => 'required|exists:users,id',
                'subject_id' => 'required|exists:subjects,id',
                'meeting' => 'required|integer|min:1', // Sesuaikan dengan jumlah pertemuan maksimum
                'score' => 'required|integer|min:0|max:100',
                'feedback' => 'nullable|string',
            ]);

            // Cek apakah data sudah ada
            $report = Report::updateOrCreate(
                [
                    'student_id' => $studentId, // Menggunakan studentId dari URL
                    'subject_id' => $request->subject_id,
                    'teacher_id' => auth()->id(),
                    'meeting' => $request->meeting,
                ],
                [
                    'score' => $request->score,
                    'feedback' => $request->feedback,
                    'date' => now(),
                ]
            );

            // Jika sukses, redirect dengan pesan sukses, sertakan kelasId
            return redirect()->route('guru.reports.laporan.index', ['studentId' => $studentId, 'kelasId' => $kelasId])
                ->with('success', 'Nilai berhasil disimpan');
        } catch (\Exception $e) {
            // Tangani error dan kirimkan pesan error
            return back()->withErrors(['error' => 'Gagal menyimpan laporan: ' . $e->getMessage()]);
        }
    }


    // Menampilkan detail tugas tertentu
    public function show($studentId, $tugasId)
    {
        $this->authorizeAccess(); // Memeriksa akses
        $user = Auth::user(); // Ambil data pengguna yang sedang login

        // Cari tugas siswa dengan ID tugas dan ID siswa yang sesuai
        $tugas = Tugas::with(['student', 'meeting.subject'])
            ->where('student_id', $studentId)
            ->findOrFail($tugasId);

        return view('guru.reports.laporan.show', compact('tugas', 'user'));
    }


    // Menampilkan form untuk mengedit tugas tertentu
    public function edit($studentId, $tugasId)
    {
        $this->authorizeAccess(); // Memeriksa akses
        $user = Auth::user(); // Ambil data pengguna yang sedang login

        // Temukan tugas dengan ID siswa yang sesuai
        $tugas = Tugas::with(['student', 'meeting.subject'])
            ->where('student_id', $studentId)
            ->findOrFail($tugasId);

        return view('guru.reports.laporan.edit', compact('tugas', 'user'));
    }

    // Memperbarui tugas setelah diedit
    public function update(Request $request, $tugasId)
    {
        try {
            $request->validate([
                'score' => 'nullable|numeric|min:0|max:100',
                'feedback' => 'nullable|string|max:255',
            ]);

            $tugas = Tugas::findOrFail($tugasId);
            $tugas->score = $request->input('score');
            $tugas->feedback = $request->input('feedback');
            $tugas->save();

            return redirect()->route('guru.reports.laporan.index', ['studentId' => $tugas->student_id])
                ->with('message', 'Laporan tugas berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal memperbarui tugas: ' . $e->getMessage()]);
        }
    }


    // Menghapus tugas tertentu
    public function destroy($reportId, $studentId, $kelasId)
    {
        try {
            // Temukan laporan berdasarkan ID dan hapus
            $report = Report::findOrFail($reportId);
            $report->delete();

            return response()->json(['success' => 'Laporan berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menghapus laporan: ' . $e->getMessage()], 500);
        }
    }





    protected function authorizeAccess()
    {
        $user = Auth::user();

        // Memeriksa apakah pengguna memiliki role_id 4 atau 3
        if (!$user || !in_array($user->role_id, [4, 3,1])) {
            throw new HttpResponseException(response()->json([
                'error' => 'Unauthorized access'
            ], 403));
        }
    }
}
