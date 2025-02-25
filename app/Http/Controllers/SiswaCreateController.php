<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaCreateController extends Controller
{
    public function createSiswa()
    {
        $user = Auth::user();

        // Fetch all unique teachers (gurus) with subjects
        $gurus = Subject::select('user_id')
        ->distinct()
        ->with('user')
        ->get()
        ->map->user
        ->filter(); // Filters out any null values
        return view('admin.users.CreateSiswa', compact('gurus', 'user'));
    }
  
    public function getKelasByGuru(Request $request)
{
    $guruIds = $request->input('guru_ids');  // Ambil array guru_ids yang dipilih

    // Validasi jika guru_ids tidak disertakan
    if (!$guruIds || !is_array($guruIds) || count($guruIds) < 1) {
        return response()->json(['error' => 'Guru tidak dipilih'], 400);
    }

    try {
        // Ambil kelas yang terkait dengan beberapa guru
        $kelas = Subject::whereIn('user_id', $guruIds)  // Mencocokkan banyak guru
            ->distinct()  // Hanya ambil kelas yang unik
            ->select('kelas_id')  // Ambil ID kelas
            ->with('kelas:id,name')  // Pastikan relasi kelas sudah terdefinisi
            ->get()
            ->pluck('kelas');  // Ambil hanya objek kelas

        // Jika tidak ada kelas yang ditemukan
        if ($kelas->isEmpty()) {
            return response()->json(['kelas' => []]);
        }

        return response()->json(['kelas' => $kelas]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
    }
}


  public function getSubjectsByKelas(Request $request)
{
    $kelasIds = $request->input('kelas_ids');  // Array kelas_id yang dipilih
    $guruIds = $request->input('guru_ids');  // Array guru_id yang dipilih

    if (!$kelasIds || !$guruIds) {
        return response()->json(['error' => 'Kelas atau Guru tidak dipilih'], 400);
    }

    try {
        // Fetch subjects based on selected kelas_ids and guru_ids
        $subjects = Subject::whereIn('kelas_id', $kelasIds)
            ->whereIn('user_id', $guruIds)  // Mengambil pelajaran berdasarkan kelas dan guru
            ->select('id', 'name', 'kelas_id', 'user_id')  // Ambil ID, nama pelajaran, kelas_id, dan user_id
            ->with(['kelas:id,name', 'user:id,name'])  // Relasi kelas dan guru (user)
            ->get();

        // Jika tidak ada pelajaran ditemukan
        if ($subjects->isEmpty()) {
            return response()->json(['subjects' => []]);
        }

        // Format hasil untuk menampilkan nama guru, kelas, dan nama pelajaran
        $formattedSubjects = $subjects->map(function ($subject) {
            return [
                'id' => $subject->id,
                'name' => $subject->name . ' - ' . $subject->kelas->name . ' - ' . $subject->user->name,  // Format: Pelajaran - Kelas - Nama Guru
            ];
        });

        return response()->json(['subjects' => $formattedSubjects]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
    }
}

    
    public function storeSiswa(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nisn_nip' => 'required|unique:users,nisn_nip',
            'guru_id' => 'required|exists:users,id',
            'kelas_id' => 'required|exists:kelas,id',
            'subject_id' => 'required|exists:subjects,id',
            'password' => 'required|min:6|confirmed',
        ]);

        DB::beginTransaction();

        try {
            $user = User::create([
                'role_id' => 4,
                'name' => $request->name,
                'email' => $request->email,
                'nisn_nip' => $request->nisn_nip,
                'password' => bcrypt($request->password),
            ]);

            $user->guru()->attach($request->guru_id);
            $user->kelas()->attach($request->kelas_id);
            $user->subjects()->attach($request->subject_id);

            DB::commit();

            return redirect()->route('admin.users.index')->with('success', 'Siswa berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error creating siswa: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data siswa.');
        }
    }


}
