<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Tugas;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
class TugasSiswaController extends Controller
{
    public function index()
    {
        $this->authorizeAccess(); // Memeriksa akses

        // Mengambil data user yang sedang login
        $user = auth()->user();
        $submissions = Submission::where('user_id', auth()->id())
        ->with('score') // Load the scores
        ->get();
        // Memuat relasi kelas melalui pivot table
        $user->load('kelas'); // Memuat relasi many-to-many 'kelas'

        // Ambil semua kelas_id yang terkait dengan user dari relasi many-to-many
        $kelas_ids = $user->kelas->pluck('id')->toArray();

        // Ambil tugas berdasarkan kelas_id yang dimiliki user
        if (!empty($kelas_ids)) {
            $tugass = Tugas::whereIn('kelas_id', $kelas_ids)->get();
        } else {
            // Jika siswa tidak terdaftar di kelas, kembalikan tugas kosong
            $tugass = collect();
        }

        // Kirim data tugas ke view
        return view('siswa.tugas.index', compact('user', 'tugass','submissions'));
    }

    public function show($id)
    {
        $this->authorizeAccess(); // Memeriksa akses

        // Ambil data tugas berdasarkan ID
        $tugas = Tugas::findOrFail($id);

        // Cek apakah tugas terkait dengan kelas yang dimiliki user
        $user = auth()->user();
        $user->load('kelas');

        // Ambil semua kelas_id yang dimiliki user
        $kelas_ids = $user->kelas->pluck('id')->toArray();

        if (!in_array($tugas->kelas_id, $kelas_ids)) {
            // Jika tugas tidak terkait dengan kelas user, redirect atau tampilkan error
            return redirect()->route('siswa.tugas.index')->with('error', 'Anda tidak memiliki akses ke tugas ini.');
        }

        // Kirim data tugas ke view
        return view('siswa.tugas.submit', compact('tugas'));
    }
    public function submitAssignment(Request $request)
    {
        $this->authorizeAccess(); // Memeriksa akses

        // Validate the incoming request
        $request->validate([
            'class' => 'required|string',
            'attendance' => 'required|string',
            'description' => 'required|string',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png', // Specify allowed file types
        ]);

        // Store the uploaded file and get the path
        $filePath = $request->file('file')->store('uploads', 'public');

        // Create a new entry in the submissions table
        Submission::create([
            'tugas_id' => $request->tugas_id, // Ensure you pass this from your form
            'user_id' => auth()->id(),
            'judul' => $request->class, // Assuming 'class' is the title
            'deskripsi' => $request->description,
            'file' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil disubmit!');
    }

    protected function authorizeAccess()
    {
        $user = Auth::user();

        // Memeriksa apakah pengguna memiliki role_id 1 atau 2
        if (!$user || !in_array($user->role_id, [4])) {
            throw new HttpResponseException(response()->json([
                'error' => 'Unauthorized access'
            ], 403));
        }
    }

}