<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use App\Models\Announcement;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Ambil pengguna yang sedang login
        $kelas = $user->kelas; // Ambil kelas yang dimiliki pengguna
        $announcements = Announcement::latest()->take(5)->get(); // Ambil 5 pengumuman terbaru

        // Ambil subjects yang hanya dimiliki user berdasarkan subject_user
        $subjects = Subject::whereHas('subject_user', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->whereIn('kelas_id', $kelas->pluck('id'))->get();

        return view('siswa.Pembelajaran', compact('subjects', 'user', 'announcements'));
    }
}
