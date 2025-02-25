<?php
namespace App\Http\Controllers;
use App\Models\Meeting; // Add this line to import the Meeting model
use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensi = Absensi::with(['user', 'meeting'])->get(); // Assuming you have relationships defined
        return view('admin.absensi.index', compact('absensi'));
    }

    public function absensiPerGuru()
    {
        // Guru yang sedang login
        $guruId = auth()->id();
        $user = Auth::user(); // Ambil data pengguna yang sedang login

        // Mendapatkan absensi yang usernya memiliki role 'siswa'
        $absensis = Absensi::with('user')
            ->whereHas('user', function ($query) {
                $query->where('role', 'siswa'); // Menyaring user dengan role 'siswa'
            })
            ->get();

        return view('guru.absensi.index', compact('absensis', 'user'));
    }

    public function detail($id)
    {
        $user = Auth::user(); // Ambil data pengguna yang sedang login
        // Ambil siswa berdasarkan ID
        $siswa = User::findOrFail($id);

        // Ambil absensi siswa dengan pagination
        $absensi = $siswa->absensi()->paginate(10); // Ubah 10 sesuai kebutuhan

        // Kirim data ke tampilan
        return view('guru.absensi.detail', compact('siswa', 'absensi', 'user'));
    }




    public function create()
    {
        return view('admin.absensi.create');
    }

    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'meeting_id' => 'required|exists:meetings,id',
        'tanggal_absen' => 'required|date',
        'status' => 'required|in:Hadir,Tidak Hadir,Izin',
    ]);

    // Membuat entry baru di tabel absensi
    Absensi::create($request->all());

    return redirect()->route('admin.absensi.index')->with('success', 'Absensi created successfully.');
}


    public function edit(Absensi $absensi)
    {
        return view('admin.absensi.edit', compact('absensi'));
    }

    public function update(Request $request, Absensi $absensi)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'meeting_id' => 'required|exists:meetings,id',
            'tanggal_absen' => 'required|date',
            'status' => 'required|in:Hadir,Tidak Hadir,Izin',
        ]);

        $absensi->update($request->all());

        return redirect()->route('admin.absensi.index')->with('success', 'Absensi updated successfully.');
    }

    public function destroy(Absensi $absensi)
    {
        $absensi->delete();

        return redirect()->route('admin.absensi.index')->with('success', 'Absensi deleted successfully.');
    }

    public function siswaAbsensiForm($meetingId)
    {
        $user = Auth::user(); // Ambil data pengguna yang sedang login

        // Retrieve the meeting
        $meeting = Meeting::findOrFail($meetingId);

        // Check if the user has already submitted attendance for this meeting
        $hasAttended = Absensi::where('meeting_id', $meetingId)
            ->where('user_id', auth()->user()->id)
            ->exists();

        return view('siswa.Absensi', compact('meeting', 'hasAttended','user'));
    }


    public function siswaAbsensiStore(Request $request, $meeting)
    {
        $validatedData = $request->validate([
            'meeting_id' => 'required|exists:meetings,id',
            'tanggal_absen' => 'required|date',
            'status' => 'required|in:Hadir,Tidak Hadir,Izin',
        ]);

        // Store the attendance in the database
        Absensi::create([
            'user_id' => auth()->user()->id, // Assuming you use authentication
            'meeting_id' => $meeting, // Get meeting ID from route
            'tanggal_absen' => $validatedData['tanggal_absen'],
            'status' => $validatedData['status'],
        ]);

        return redirect()->back()->with('success', 'Absensi successfully submitted.');
    }


}
