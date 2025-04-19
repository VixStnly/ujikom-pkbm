<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Subject;
use App\Models\Kelas; // Import the Kelas model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserController extends Controller
{
    public function index(Request $request)
{
    $this->authorizeAccess();

    $user = Auth::user();

    $search = $request->input('search');
    $role_id = $request->query('role_id');

    $roles = Role::all();

    // Default query: ambil semua user kecuali role_id 1
    $query = User::with(['role', 'subjects.kelas'])
                 ->where('role_id', '!=', 1); // Jangan tampilkan user dengan role_id 1

    // Jika ada filter role_id, override pengecualian
    if ($role_id) {
        $query->where('role_id', $role_id);
    }

    // Jika ada pencarian
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('nisn_nip', 'like', "%{$search}%");
        });
    }

    $users = $query->paginate(8);

    $recentActivities = User::orderBy('created_at', 'desc')->limit(10)->get();

    return view('admin.users.index', compact('users', 'roles', 'search','user'));
}

    public function show($id)
    {
        $this->authorizeAccess(); // Authorization check
    
        $user = User::with(['role', 'kelas', 'subjects'])->findOrFail($id);
    
        return view('admin.users.show', compact('user'));
    }
    
    
    public function create()
    {
        $this->authorizeAccess(); // Memeriksa akses
        $user = Auth::user(); // Ambil data pengguna yang sedang login

        $roles = Role::where('id', '<=', 3)->get();
        $kelas = Kelas::all(); // Fetch all Kelas for the dropdown
        $subjects = Subject::all(); // Fetch all Subjects (Pelajaran) for the dropdown
        return view('admin.users.create', compact('roles', 'kelas', 'subjects','user'));
    }
    

    public function store(Request $request)
    {
        $this->authorizeAccess(); // Memeriksa akses
    
        // Check if the role is Admin, Super Admin, or Teacher (role_id = 3)
        $isAdminOrSuperAdmin = in_array($request->role_id, [1, 2]); // Assuming 1 is Admin and 2 is Super Admin
        $isTeacher = $request->role_id == 3; // Check if role_id is Teacher
    
        // Validation rules
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'nisn_nip' => $isAdminOrSuperAdmin ? 'nullable|string|max:255' : 'required|string|max:255|unique:users,nisn_nip',
            'password' => 'required|string|min:8',
            'role_id' => 'required|integer',
            // Kelas is nullable for Admin or Super Admin, required for Teacher
            'kelas' => $isAdminOrSuperAdmin ? 'nullable|array' : 'required|array',
            // Subjects are nullable for Admin, Super Admin, and Teacher
            'subjects' => $isAdminOrSuperAdmin || $isTeacher ? 'nullable|array' : 'required|array',
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'nisn_nip.unique' => 'NISN/NIP sudah digunakan.', // Custom error message for duplicate nisn_nip
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password harus memiliki minimal 8 karakter.',
        ]);
    
        // Create the user
        try {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'nisn_nip' => $validated['nisn_nip'],
                'password' => Hash::make($validated['password']),
                'role_id' => $validated['role_id'],
            ]);
    
            // Attach the selected classes to the user (Kelas) - if not Admin or Super Admin
            if (!$isAdminOrSuperAdmin && !$isTeacher) {
                $user->kelas()->attach($validated['kelas']); // This attaches the classes to the pivot table
            }
    
            // Attach the selected subjects to the user (if not Admin or Super Admin)
            if (!$isAdminOrSuperAdmin && !$isTeacher) {
                $user->subjects()->attach($validated['subjects']);
            } elseif ($isTeacher) {
                // Attach the classes to the teacher (since a teacher needs to belong to classes)
                $user->kelas()->attach($validated['kelas']);
            }
    
            // Redirect after successful creation
            return redirect()->route('admin.users.index')->with('success', 'Buat akun berhasil.');
        } catch (\Exception $e) {
            // Handle exception and redirect back with error message
            return redirect()->back()->withErrors(['email.unique' => 'Email sudah digunakan.'])->withInput();
        }
    }
    
    
    public function edit(User $user)
    {
        $this->authorizeAccess(); // Memeriksa akses
    
        $roles = Role::all(); // Ambil semua role
        $kelas = Kelas::all(); // Ambil semua kelas untuk dropdown
    $subjects = Subject::with(['kelas', 'users'])->get(); // Ambil subjects beserta relasi kelas dan users
    
        // Cek apakah role_id user adalah 4 (Siswa)
        if ($user->role_id == 4) {
            // Ambil daftar guru (users dengan role_id 3)
            $allGurus = User::where('role_id', 3)->get(); // Ambil semua guru dengan role_id 3
            $userGurus = $user->guru->pluck('id')->toArray(); // Guru yang sudah dimiliki siswa
            $gurus = $allGurus->map(function($guru) use ($userGurus) {
                $guru->selected = in_array($guru->id, $userGurus);
                return $guru;
            });
            // Ambil guru yang saat ini terkait dengan siswa ini
            $currentGurus = $user->guru; // Ambil semua guru yang saat ini terkait dengan siswa
    
            return view('admin.users.EditSiswa', compact('user', 'roles', 'kelas', 'subjects', 'gurus', 'currentGurus'));
        } else {
            return view('admin.users.edit', compact('user', 'roles', 'kelas', 'subjects',));
        }
    }public function update(Request $request, User $user)
    {
        $this->authorizeAccess();
    
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
            'kelas_id' => 'nullable|array',
            'kelas_id.*' => 'exists:kelas,id',
            'password' => 'nullable|confirmed|min:6',
            'guru_id' => 'nullable|array', // Validasi bahwa guru_id bisa kosong atau array
            'guru_id.*' => 'exists:users,id', // Pastikan setiap guru_id ada di tabel users
        ];
    
        // Jika role bukan Admin (1), Super Admin (2), atau Guru (3), subject_id wajib
        if (!in_array($request->role_id, [1, 2, 3])) {
            $rules['nisn_nip'] = 'required|unique:users,nisn_nip,' . $user->id;
            $rules['subject_id'] = 'required|array';
            $rules['subject_id.*'] = 'exists:subjects,id';
        } else {
            $rules['nisn_nip'] = 'nullable|unique:users,nisn_nip,' . $user->id;
            $rules['subject_id'] = 'nullable|array';
            $rules['subject_id.*'] = 'exists:subjects,id';
        }
    
        $request->validate($rules);
    
        $user->update([
            'nisn_nip' => $request->nisn_nip,
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);
    
        if ($request->has('kelas_id')) {
            $user->kelas()->sync($request->input('kelas_id', []));
        }
    
        if ($request->has('subject_id')) {
            $user->subjects()->sync($request->input('subject_id', []));
        }
    
        // Sinkronisasi guru untuk siswa (role_id 4)
        if ($user->role_id == 4 && $request->has('guru_id')) {
            $user->guru()->sync($request->input('guru_id', [])); // Sinkronisasi guru
        }
    
        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }
    

    // Remove the specified user from storage
    public function destroy(User $user)
    {
        $this->authorizeAccess(); // Memeriksa akses

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Data Berhasil Dihapus.');
    }
    protected function authorizeAccess()
    {
        $user = Auth::user();
    
        // Memeriksa apakah pengguna memiliki role_id 1 atau 2
        if (!$user || !in_array($user->role_id, [1, 2])) {
            // Redirect ke halaman /akses jika pengguna tidak memiliki akses
            abort(redirect('/akses'));
        }
    }
    
    public function getSubjects(Request $request)
    {
        // Ensure that ids are received as an array
        $ids = $request->input('ids');
    
        // If ids are a single string, convert it to an array
        if (!is_array($ids)) {
            $ids = [$ids];
        }
    
        // Now you can safely use count() on the array
        if (count($ids) === 0) {
            return response()->json([]);
        }
    
        // Fetch subjects based on the selected class IDs
        $subjects = Subject::whereIn('kelas_id', $ids)->get();
    
        return response()->json($subjects);
    }
    




}
