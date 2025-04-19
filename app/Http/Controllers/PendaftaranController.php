<?php
namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class PendaftaranController extends Controller
{
    public function index()
    {
        return view('landing.pendaftaran');
    }
    public function show()
    {
        $user = Auth::user(); // Get the logged-in user

        // Fetch all pendaftaran records
        $pendaftarans = Pendaftaran::all(); // This will fetch all records
        
        // Pass the data to the view
        return view('admin.pendaftaran.show', compact('pendaftarans','user'));
    }
    public function adminView(Request $request)
    {
        $user = Auth::user(); // Get the logged-in user
    
        // Fetch paginated data with optional search filter
        $pendaftarans = Pendaftaran::query()
            ->when($request->search, function ($query) use ($request) {
                return $query->where('nama_lengkap', 'like', '%' . $request->search . '%');
            })
            ->paginate(10); // Adjust the number per page as needed
    
        return view('admin.pendaftaran.index', compact('pendaftarans', 'user'));
    }
    public function edit($id)
{
    $user = Auth::user(); // Get the logged-in user

    // Find the existing pendaftaran record by its ID
    $pendaftaran = Pendaftaran::findOrFail($id);

    // Pass the pendaftaran data to the edit view
    return view('admin.pendaftaran.edit', compact('pendaftaran','user'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'nama_lengkap' => 'required',
        'nik' => 'required|unique:pendaftaran,nik,' . $id, // Allow the current record to keep its unique value
        'tempat_lahir' => 'required',
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'agama' => 'required',
        'email' => 'required|email|unique:pendaftaran,email,' . $id, // Allow the current record to keep its unique value
        'telepon' => 'required',
        'alamat' => 'required',
        'paket' => 'required|in:A,B,C',
        'status' => 'required',
    ]);

    try {
        // 1. Find the existing pendaftaran record
        $pendaftaran = Pendaftaran::findOrFail($id);

        // 2. Update the pendaftaran table
        $pendaftaran->update([
            'nama_lengkap' => $request->nama_lengkap,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'paket' => $request->paket,
            'status' => $request->status,
        ]);

        // Flash success message
        session()->flash('success', 'Pendaftaran berhasil diupdate.');

        // Redirect back to the pendaftaran list
        return redirect()->route('admin.pendaftaran.index');

    } catch (\Exception $e) {
        // Flash error message
        session()->flash('error', 'Terjadi kesalahan, update pendaftaran gagal. Silakan coba lagi.');

        // Kembali ke halaman pendaftaran dengan error
        return redirect()->route('admin.pendaftaran.index');
    }
}


    public function destroy($id)
    {
        try {
            // Find the pendaftaran entry by ID
            $pendaftaran = Pendaftaran::findOrFail($id);

            // Delete the record
            $pendaftaran->delete();

            // Flash success message
            session()->flash('success', 'Pendaftaran deleted successfully.');
        } catch (\Exception $e) {
            // Flash error message in case of failure
            session()->flash('error', 'Failed to delete Pendaftaran. Please try again.');
        }

        // Redirect back to the Pendaftaran index page
        return redirect()->route('admin.pendaftaran.index');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'nik' => 'required|unique:pendaftaran,nik|unique:users,nisn_nip',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required',
            'email' => 'required|email|unique:pendaftaran,email|unique:users,email',
            'telepon' => 'required',
            'alamat' => 'required',
            'paket' => 'required|in:A,B,C',
            'status' => 'required',
        ]);
    
        try {
            // 1. Simpan ke tabel pendaftaran
            $pendaftaran = Pendaftaran::create([
                'nama_lengkap' => $request->nama_lengkap,
                'nik' => $request->nik,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'email' => $request->email,
                'telepon' => $request->telepon,
                'alamat' => $request->alamat,
                'paket' => $request->paket,
                'status' => $request->status,
            ]);
    
            // 2. Simpan ke tabel users
            User::create([
                'name' => $request->nama_lengkap,
                'email' => $request->email,
                'nisn_nip' => $request->nik,
                'password' => Hash::make('password'), // default password
                'role_id' => 4, // siswa
            ]);
    
            // 3. Kirim ke WhatsApp Admin
            $pesan = "Halo, saya ingin mendaftar PKBM.%0A"
                . "Nama Lengkap: *{$request->nama_lengkap}*%0A"
                . "NIK: *{$request->nik}*%0A"
                . "Tempat Lahir: *{$request->tempat_lahir}*%0A"
                . "Tanggal Lahir: *{$request->tanggal_lahir}*%0A"
                . "Jenis Kelamin: *{$request->jenis_kelamin}*%0A"
                . "Agama: *{$request->agama}*%0A"
                . "Email: *{$request->email}*%0A"
                . "Telepon: *{$request->telepon}*%0A"
                . "Alamat: *{$request->alamat}*%0A"
                . "Pilihan Paket: *{$request->paket}*%0A%0A"
                . "Mohon informasi lebih lanjut terkait pendaftaran saya. Terima kasih.";
    
            $nomor_admin = "62895613113418";
            $link_wa = "https://wa.me/{$nomor_admin}?text={$pesan}";
    
            // Flash success message
            session()->flash('success', 'Pendaftaran berhasil! Admin telah diberitahu melalui WhatsApp.');
    
            // Redirect ke link WhatsApp
            return redirect($link_wa);
    
        } catch (\Exception $e) {
            // Flash error message
            session()->flash('error', 'Terjadi kesalahan, pendaftaran gagal. Silakan coba lagi.');
    
            // Kembali ke halaman pendaftaran dengan error
            return redirect()->route('pendaftaran.index');
        }
    }
    
    
}
