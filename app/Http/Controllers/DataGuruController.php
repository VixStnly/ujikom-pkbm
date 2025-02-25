<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;

class DataGuruController extends Controller
{
    public function index(Request $request)
    {
        $this->authorizeAccess(); // Memeriksa akses
        $user = Auth::user(); // Ambil data pengguna yang sedang login

        $search = $request->input('search');

        // Ambil semua roles untuk dropdown
        $roles = Role::all(); // Assuming you have a Role model
    
        // Default query untuk pengguna dengan role_id 3 (guru) dan eager load subjects dan kelas
        $query = User::with(['role', 'subjects.kelas'])
                      ->where('role_id', 3); // Hanya ambil pengguna dengan role_id 3
    
        // Jika ada parameter pencarian, tambahkan filter pencarian
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('nisn_nip', 'like', "%{$search}%");
            });
        }
    
        // Paginate results
        $users = $query->paginate(8); // Ganti 10 dengan jumlah item yang ingin Anda tampilkan per halaman
    
        // Fetch the 5 most recent activities
        $recentActivities = User::orderBy('created_at', 'desc')
                                 ->limit(10)
                                 ->get();
    
        return view('admin.dataGuru.index', compact('users', 'roles', 'search', 'user'));
    }
      protected function authorizeAccess()
    {
        $user = Auth::user();

        // Memeriksa apakah pengguna memiliki role_id 1 atau 2
        if (!$user || !in_array($user->role_id, [1, 2])) {
            throw new HttpResponseException(response()->json([
                'error' => 'Unauthorized access'
            ], 403));
        }
    }

    public function impersonate(User $user)
    {
        if (Auth::user()->isAdmin()) { // Ensure only admins can impersonate
            session()->put('impersonate', Auth::id()); // Save admin's ID in session
            Auth::login($user); // Log in as the selected user

            return redirect('/dashboard')->with('success', 'You are now impersonating ' . $user->name);
        }

        return redirect()->back()->with('error', 'Unauthorized');
    }

    // End impersonation
    public function leaveImpersonation()
    {
        if (session()->has('impersonate')) {
            Auth::loginUsingId(session()->get('impersonate')); // Log back in as admin
            session()->forget('impersonate'); // Remove impersonation session data

            return redirect('/admin/guru')->with('success', 'Kamu Telah Berhenti Monitoring.');
        }

        return redirect()->back()->with('error', 'You are not impersonating any user.');
    }

}
