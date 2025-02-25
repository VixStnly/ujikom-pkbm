<?php

namespace App\Http\Controllers;

use App\Models\pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;

class PengumumanController extends Controller
{
    // Menampilkan semua pengumuman
    public function index()
    {
        $this->authorizeAccess(); // Memeriksa akses

        $pengumuman = pengumuman::all();
        return view('admin.pengumuman.index', compact('pengumuman'));
    }

    // Menampilkan form untuk membuat pengumuman baru
    public function create()
    {
        $this->authorizeAccess(); // Memeriksa akses

        return view('admin.pengumuman.create');
    }

    // Menyimpan pengumuman baru
    public function store(Request $request)
    {
        $this->authorizeAccess(); // Memeriksa akses

        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        pengumuman::create($request->all());
        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman dibuat dengan sukses.');
    }

    // Menampilkan pengumuman spesifik
    public function show(pengumuman $pengumuman)
    {
        $this->authorizeAccess(); // Memeriksa akses

        return view('admin.pengumuman.show', compact('pengumuman'));
    }

    // Menampilkan form untuk mengedit pengumuman
    public function edit(pengumuman $pengumuman)
    {
        $this->authorizeAccess(); // Memeriksa akses

        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    // Memperbarui pengumuman
    public function update(Request $request, pengumuman $pengumuman)
    {
        $this->authorizeAccess(); // Memeriksa akses

        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $pengumuman->update($request->all());
        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman diperbarui dengan sukses.');
    }

    // Menghapus pengumuman
    public function destroy(pengumuman $pengumuman)
    {
        $this->authorizeAccess(); // Memeriksa akses

        $pengumuman->delete();
        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman dihapus dengan sukses.');
    }

    protected function authorizeAccess()
    {
        $user = Auth::user();

        // Memeriksa apakah pengguna memiliki role_id 1 atau 2
        if (!$user || !in_array($user->role_id, [1,2])) {
            abort(redirect('/akses'));

        }
    }
}
