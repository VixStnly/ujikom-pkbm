<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\User;

class KelasUserController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel pivot kelas_user dengan relasi kelas dan user
        $kelasUsers = Kelas::with('users')->get();
        return view('kelas_user.index', compact('kelasUsers'));
    }

public function create()
{
    $users = User::where('role_id', 3)->get(); // Ambil user dengan role_id 3
    $grades = Kelas::select('grade')->distinct()->get(); // Ambil daftar grade unik
    return view('kelas_user.create', compact('users', 'grades'));
}

public function store(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'kelas_id' => 'required|exists:kelas,id',
        'user_id' => 'required|array',
        'user_id.*' => 'exists:users,id',
    ]);

    $kelas = Kelas::findOrFail($validated['kelas_id']);
    $kelas->users()->sync($validated['user_id']); // Menyinkronkan data, menggantikan semua pengguna yang ada dengan yang baru

    return redirect()->route('kelas_user.index')->with('success', 'Users assigned to Kelas successfully.');
}

    public function destroy($kelas_id, $user_id)
{
    // Temukan kelas dan hapus pengguna terkait dari kelas
    $kelas = Kelas::findOrFail($kelas_id);
    $kelas->users()->detach($user_id);

    return redirect()->route('kelas_user.index')->with('success', 'User removed from Kelas.');
}
}
