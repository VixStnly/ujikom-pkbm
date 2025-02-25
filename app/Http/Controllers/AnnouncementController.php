<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;

class AnnouncementController extends Controller
{
    // Menampilkan semua pengumuman
    public function index()
    {
        $this->authorizeAccess(); // Memeriksa akses
        $query = Announcement::query();

        $user = Auth::user();
        $announcements = $query->paginate(6); // Display 6 items per page

        return view('admin.announcements.index', compact('announcements','user'));
    }

    // Menampilkan form untuk membuat pengumuman baru
    public function create()
    {
        $this->authorizeAccess(); // Memeriksa akses
        $user = Auth::user();

        return view('admin.announcements.create' , compact('user'));
    }

    // Menyimpan pengumuman baru
    public function store(Request $request)
    {
        $this->authorizeAccess(); // Memeriksa akses

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ], [
            'title.required' => 'Judul pengumuman harus diisi.',
            'title.string' => 'Judul harus berupa teks.',
            'title.max' => 'Judul tidak boleh lebih dari 255 karakter.',
            'description.required' => 'Deskripsi pengumuman harus diisi.',
            'description.string' => 'Deskripsi harus berupa teks.',
        ]);

        Announcement::create($request->all());
        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman dibuat dengan sukses.');
    }

    // Menampilkan pengumuman spesifik
    public function show(Announcement $announcement)
    {
        $this->authorizeAccess(); // Memeriksa akses
        $user = Auth::user();

        return view('admin.announcements.show', compact('announcement','user'));
    }

    // Menampilkan form untuk mengedit pengumuman
    public function edit(Announcement $announcement)
    {
        $this->authorizeAccess(); // Memeriksa akses
        $user = Auth::user();

        return view('admin.announcements.edit', compact('announcement','user'));
    }

    // Memperbarui pengumuman
    public function update(Request $request, Announcement $announcement)
    {
        $this->authorizeAccess(); // Memeriksa akses

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ], [
            'title.required' => 'Judul pengumuman harus diisi.',
            'title.string' => 'Judul harus berupa teks.',
            'title.max' => 'Judul tidak boleh lebih dari 255 karakter.',
            'description.required' => 'Deskripsi pengumuman harus diisi.',
            'description.string' => 'Deskripsi harus berupa teks.',
        ]);

        $announcement->update($request->all());
        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman diperbarui dengan sukses.');
    }

    // Menghapus pengumuman
    public function destroy(Announcement $announcement)
    {
        $this->authorizeAccess(); // Memeriksa akses

        $announcement->delete();
        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman dihapus dengan sukses.');
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
