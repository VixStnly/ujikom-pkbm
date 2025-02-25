<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
class GuruController extends Controller
{
    // Display the teacher's dashboard
    public function index()
    {
        $this->authorizeAccess(); // Memeriksa akses

        $user = Auth::user(); // Ambil data pengguna yang sedang login
        
        if (Auth::check() && auth()->user()->role === 'guru') {
            $kelas = Kelas::where('user_id', auth()->user()->id)->get();

            if ($kelas->isEmpty()) {
                return view('dashboard.guru', ['message' => 'Anda belum memiliki jadwal mengajar.']);
            }

            return view('dashboard.guru', compact('kelas', 'user'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function showKelas($id)
    {
        $this->authorizeAccess(); // Memeriksa akses

        $kelas = Kelas::findOrFail($id);
        $tugass = $kelas->tugas()->where('user_id', Auth::id())->get(); // Tugas yang ditugaskan oleh guru yang sedang login
        $materi = $kelas->materi()->where('user_id', Auth::id())->get(); // Materi yang ditugaskan oleh guru yang sedang login
        $meetings = $kelas->meeting()->where('user_id', Auth::id())->get(); // Materi yang ditugaskan oleh guru yang sedang login

        return view('guru.kelas.index', compact('kelas', 'tugass', 'materi', 'meetings'));
    }
    protected function authorizeAccess()
    {
        $user = Auth::user();

        // Memeriksa apakah pengguna memiliki role_id 1 atau 2
        if (!$user || !in_array($user->role_id, [3])) {
            abort(redirect('/akses'));

        }
    }
}
