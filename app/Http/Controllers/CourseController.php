<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;

class CourseController extends Controller
{
    /**
     * Tampilkan form untuk membuat mata pelajaran baru.
     */
    public function index()
    {
        $this->authorizeAccess(); // Memeriksa akses

        // Ambil semua kelas dengan pelajaran yang terkait
        $kelas = Kelas::with('subjects')->get();

        return view('admin.courses.index', [
            'kelas' => $kelas,
            'user' => Auth::user(),
        ]);
    }

    public function create()
    {
        $this->authorizeAccess(); // Memeriksa akses

        // Mengambil semua data kelas dari database
        $kelas = Kelas::all();

        // Mengambil data pengguna dengan role_id = 3 (Guru)
        $users = User::where('role_id', 3)->get();

        // Kirim data kelas dan pengguna (guru) ke view
        return view('admin.courses.create', [
            'kelas' => $kelas,
            'user' => Auth::user(),
            'users' => $users, // Data pengguna dengan role guru
        ]);
    }


    /**
     * Simpan mata pelajaran baru ke dalam database.
     */
    public function store(Request $request)
    {
        $this->authorizeAccess(); // Memeriksa akses

        // Tambahkan validasi untuk 'guru_id'
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'kelas' => 'required|integer',
            'user_id' => 'required|exists:users,id', // Validasi untuk guru_id
            'image' => 'image|nullable|max:2048',
        ], [
            'name.required' => 'Nama mata pelajaran harus diisi.',
            'description.required' => 'Deskripsi mata pelajaran harus diisi.',
            'kelas.required' => 'Kelas harus dipilih.',
            'user_id.required' => 'Guru harus dipilih.', // Pesan kesalahan untuk guru_id
            'image.image' => 'File harus berupa gambar.',
            'image.max' => 'Gambar harus maksimal 2MB.',
        ]);

        // Buat instance baru dari model Subject dan simpan data dari form
        $subject = new Subject();
        $subject->name = $request->name;
        $subject->description = $request->description;
        $subject->kelas_id = $request->kelas;
        $subject->user_id = $request->user_id; // Simpan guru_id

        // Simpan gambar jika ada
        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('pelajaran', $fileName, 'public'); // Simpan di folder pelajaran
            $subject->image = $fileName;
        }

        $subject->save();

        return redirect()->route('admin.courses.index')->with('success', 'Pembelajaran berhasil dibuat.');
    }


    public function edit($id)
    {
        $this->authorizeAccess(); // Memeriksa akses

        $subject = Subject::findOrFail($id);
        $kelasOptions = Kelas::all();
        $users = User::where('role_id', 3)->get();

        return view('admin.courses.edit', [
            'subject' => $subject,
            'kelasOptions' => $kelasOptions,
            'user' => Auth::user(),
            'users' => $users, // Data pengguna dengan role guru
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->authorizeAccess(); // Memeriksa akses

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'kelas_id' => 'required|integer',
            'user_id' => 'required|exists:users,id', // Validasi untuk guru_id
            'image' => 'image|nullable|max:2048',
        ], [
            'name.required' => 'Nama mata pelajaran harus diisi.',
            'description.required' => 'Deskripsi mata pelajaran harus diisi.',
            'kelas_id.required' => 'Kelas harus dipilih.',
            'user_id.required' => 'Guru harus dipilih.', // Pesan kesalahan untuk guru_id
            'image.image' => 'File harus berupa gambar.',
            'image.max' => 'Gambar harus maksimal 2MB.',
        ]);

        $subject = Subject::findOrFail($id);
        $subject->name = $request->name;
        $subject->description = $request->description;
        $subject->kelas_id = $request->kelas_id;
        $subject->user_id = $request->user_id; // Simpan guru_id

        // Jika ada file gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($subject->image) {
                Storage::disk('public')->delete('pelajaran/' . $subject->image);
            }

            // Simpan gambar baru
            $fileName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('pelajaran', $fileName, 'public');
            $subject->image = $fileName;
        }

        $subject->save();

        return redirect()->route('admin.courses.index')->with('success', 'Pelajaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->authorizeAccess(); // Memeriksa akses

        $subject = Subject::findOrFail($id);

        // Jika ada gambar yang terkait, hapus gambar dari storage
        if ($subject->image) {
            Storage::disk('public')->delete('pelajaran/' . $subject->image);
        }

        // Hapus mata pelajaran
        $subject->delete();

        return redirect()->route('admin.courses.index')->with('success', 'Pelajaran Berhasil Dihapus.');
    }

    protected function authorizeAccess()
    {
        $user = Auth::user();

        if (!$user || !in_array($user->role_id, [1, 2])) {
            abort(redirect('/akses'));

        }
    }
}
