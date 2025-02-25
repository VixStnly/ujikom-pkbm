<?php

// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;
use App\Models\Task; // Import the Task model
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Tugas;
use App\Models\Kelas;
use App\Models\Subject;
use App\Models\Absensi;
use App\Models\Materi;
use App\Models\Meeting;
use App\Models\Submission;
use App\Models\Score;
use App\Models\Activity;
use App\Models\Reply;
use Carbon\Carbon;
use App\Models\Announcement;

use App\Models\Comment; // Add this line

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        switch ($user->role_id) {
            case 1: // Super Admin
                $comments = Comment::whereNull('parent_id')
                    ->with('replies.user')  // Eager load replies and their users
                    ->with('user')  // Eager load the user who made the comment
                    ->latest()
                    ->take(5)  // Limit to 5 latest comments
                    ->get();


                // Other logic for dashboard data
                $fiveTasks = Task::orderBy('created_at', 'desc')->take(5)->get();
                $tasks = Task::all();
                $totalTasks = $tasks->count();
                $completedTasks = $tasks->where('completed', true)->count();
                $progressPercentage = $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0;

                // Fetch counts for cards
                $totalUsers = User::count();
                $adminCount = User::where('role_id', 2)->count(); // Role ID for Admins
                $guruCount = User::where('role_id', 3)->count();  // Role ID for Gurus
                $siswaCount = User::where('role_id', 4)->count();  // Role ID for Students
                $kelasCount = Kelas::count();

                // Fetch recent activities (for example, last 5 tasks)
                $recentActivities = Task::latest()->take(5)->get();

                // Group tasks by created_at date and count
                $tasksPerDay = Task::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
                    ->groupBy('date')
                    ->orderBy('date', 'asc')
                    ->get();

                // Pass all the data to the view
                return view('dashboard.super_admin', compact(
                    'progressPercentage',
                    'user',
                    'tasks',
                    'recentActivities',
                    'totalUsers',
                    'adminCount',
                    'guruCount',
                    'siswaCount',
                    'kelasCount',
                    'completedTasks',
                    'totalTasks',
                    'tasksPerDay',
                    'fiveTasks', // Add tasksPerDay to view
                    'comments' // Add comments to view
                ));



            case 2: // Admin
                $comments = Comment::whereNull('parent_id')  // Ambil komentar tanpa balasan
                    ->with('replies.user')  // Eager load replies dan pengguna
                    ->with('user')  // Eager load pengguna yang membuat komentar
                    ->latest()  // Urutkan berdasarkan tanggal terbaru
                    ->take(5)  // Ambil hanya 5 komentar terbaru
                    ->get();

                // Other logic for dashboard data
                $fiveTasks = Task::orderBy('created_at', 'desc')->take(5)->get();
                $tasks = Task::all();
                $totalTasks = $tasks->count();
                $completedTasks = $tasks->where('completed', true)->count();
                $progressPercentage = $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0;

                // Fetch counts for cards
                $totalUsers = User::count();
                $adminCount = User::where('role_id', 2)->count(); // Role ID for Admins
                $guruCount = User::where('role_id', 3)->count();  // Role ID for Gurus
                $siswaCount = User::where('role_id', 4)->count();  // Role ID for Students

                // Fetch recent activities (for example, last 5 tasks)
                $recentActivities = Task::latest()->take(5)->get();

                // Group tasks by created_at date and count
                $tasksPerDay = Task::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
                    ->groupBy('date')
                    ->orderBy('date', 'asc')
                    ->get();

                // Pass all the data to the view
                return view('dashboard.admin', compact(
                    'progressPercentage',
                    'user',
                    'tasks',
                    'recentActivities',
                    'totalUsers',
                    'adminCount',
                    'guruCount',
                    'siswaCount',
                    'completedTasks',
                    'totalTasks',
                    'tasksPerDay',
                    'fiveTasks', // Add tasksPerDay to view
                    'comments' // Add comments to view
                ));


            case 3: // Guru
                // Mengambil data user dan relasi kelas menggunakan eager loading
                // Mengambil data user yang sedang login
                $user = auth()->user();
                $role = $user->role;

                // Hitung jumlah subjects yang terhubung dengan user melalui tabel pivot subject_user
                $enrolledSubjectsCount = $user->enrolledSubjects()->count();

                // Mengambil submission yang belum dinilai
                $ungradedSubmissionsCount = Submission::whereDoesntHave('score')
                    ->whereHas('tugas', function ($query) use ($user) {
                        $query->where('user_id', $user->id);
                    })
                    ->count();


                // Hitung jumlah kelas dan informasi lainnya
                $materiCount = Materi::where('user_id', $user->id)->count();
                $kelasCount = Kelas::count();
                $tugasCount = Tugas::where('user_id', $user->id)->count();
                $meetingCount = Meeting::where('user_id', $user->id)->count();

                // Pastikan eager load relasi 'kelas' pada user
                $user->load('kelas'); // Pastikan model User memiliki relasi kelas

                // Ambil semua tugas untuk guru
                $tugass = Tugas::where('user_id', $user->id)->with('submissionsTugas.siswa', 'submissionsTugas.score')->get();

                // Kirim data ke view
                return view('dashboard.guru', compact(
                    'user',
                    'role',
                    'enrolledSubjectsCount',
                    'materiCount',
                    'kelasCount',
                    'tugasCount',
                    'tugass',
                    'meetingCount',
                    'ungradedSubmissionsCount'
                ));



            case 4: // Siswa
                $user = auth()->user();
                $subjectCount = $user->subjects()->count();
                $subjects = $user->subjects;
                $announcements = Announcement::latest()->take(5)->get(); // Ambil 5 pengumuman terbaru

                // Menghitung total absensi untuk user yang sedang login
                $absenCount = Absensi::where('user_id', $user->id)->count(); // Ambil total absensi berdasarkan user_id

                $submissionCount = Submission::where('user_id', $user->id)->count();

                // Mengambil data kelas siswa yang sedang login
                $user->load('kelas'); // Pastikan model User memiliki relasi kelas

                // Mengambil komentar terbaru tanpa balasan
                $comments = Comment::whereNull('parent_id')  // Ambil komentar tanpa balasan
                    ->with('replies.user')  // Eager load replies dan pengguna
                    ->with('user')  // Eager load pengguna yang membuat komentar
                    ->latest()  // Urutkan berdasarkan tanggal terbaru
                    ->take(5)  // Ambil hanya 5 komentar terbaru
                    ->get();

                return view('dashboard.siswa', compact('comments', 'user', 'subjectCount', 'absenCount', 'submissionCount', 'announcements'));

            default:
                abort(403, 'Unauthorized action.');

        }
    }
}
