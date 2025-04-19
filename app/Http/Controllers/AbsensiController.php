<?php
namespace App\Http\Controllers;
use App\Models\Meeting; // Add this line to import the Meeting model
use App\Models\Absensi;
use App\Models\User;
use GuzzleHttp\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Http;
class AbsensiController extends Controller
{
   
    public function compareFace(Request $request)
    {
        $imageData = $request->input('photo_data');
        $imageData = str_replace('data:image/png;base64,', '', $imageData);
        $imageData = base64_decode($imageData);
    
        $user = Auth::user();
        $registeredPhotoPath = $user->face_photo;
        $registeredPhotoData = base64_encode(file_get_contents(storage_path("app/public/{$registeredPhotoPath}")));
    
        $client = new \GuzzleHttp\Client();
        $res = $client->post('https://api-us.faceplusplus.com/facepp/v3/compare', [
            'form_params' => [
                'api_key' => 'HGnUFFwOfHMy8_TZ5GP1BZ3sglmJ-uy0',
                'api_secret' => 'NzETb4zN3FHKZv-bGGJzaIcPzm-HACWz',
                'image_base64_1' => base64_encode($imageData),
                'image_base64_2' => $registeredPhotoData,
            ]
        ]);
    
        $data = json_decode($res->getBody(), true);
        return response()->json([
            'confidence' => $data['confidence'] ?? null
        ]);
    }public function processAbsence(Request $request)
    {
        try {
            // Get user
            $user = Auth::user();
            
            // Check if the status is 'tidak hadir' or 'izin'
            if ($request->status === 'tidak hadir' || $request->status === 'izin') {
                // Different validation for sick/permission status
                $validated = $request->validate([
                    'meeting_id' => 'required|exists:meetings,id',
                    'status' => 'required|in:tidak hadir,izin',
                    'tanggal_absen' => 'required'
                ]);
                
                // Create absence record without photo/location data
                $absence = $user->absensi()->create([
                    'meeting_id' => $request->meeting_id,
                    'tanggal_absen' => $request->tanggal_absen,
                    'status' => $request->status
                    // No photo, confidence, latitude, or longitude needed
                ]);
                
                // Log the created absence record
                \Log::info('Absence record created for sick/permission', [
                    'id' => $absence->id,
                    'status' => $request->status
                ]);
                
                return redirect()->back()->with('success', 'Absensi dengan status ' . ucfirst($request->status) . ' berhasil dikirim.');
            } 
            // If status is 'hadir', proceed with the original validation and face verification
            else {
                // Validate the request for 'hadir' status
                $validated = $request->validate([
                    'photo_data' => 'required|string',  // Foto yang diambil saat absensi
                    'latitude' => 'required|numeric',    // Latitude lokasi
                    'longitude' => 'required|numeric',   // Longitude lokasi
                    'meeting_id' => 'required|exists:meetings,id', // ID meeting yang dihadiri
                ]);
        
                // Log the received data for debugging
                \Log::info('Absence data received', [
                    'meeting_id' => $request->meeting_id,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                    'photo_data_length' => strlen($request->photo_data)
                ]);
        
                // Process the image data
                $imageData = $request->input('photo_data');
                // Make sure we're extracting just the base64 data part
                if (strpos($imageData, 'data:image/png;base64,') !== false) {
                    $imageData = str_replace('data:image/png;base64,', '', $imageData);
                }
                $imageData = base64_decode($imageData);
        
                if (!$imageData) {
                    \Log::error('Failed to decode base64 image data');
                    return redirect()->back()->with('error', 'Format foto tidak valid.');
                }
        
                // Save photo to storage first
                $fileName = 'absensi_' . $user->id . '_' . time() . '.png';
                $filePath = 'absensi_photos/' . $fileName;
                
                // Make sure directory exists
                Storage::disk('public')->makeDirectory('absensi_photos', 0755, true, true);
                
                // Save the image
                if (!Storage::disk('public')->put($filePath, $imageData)) {
                    \Log::error('Failed to save image to storage');
                    return redirect()->back()->with('error', 'Gagal menyimpan foto.');
                }
        
                // Ambil foto wajah pengguna yang sudah terdaftar
                $registeredPhotoPath = $user->face_photo;
                
                // Verify that the registered photo exists
                if (!Storage::disk('public')->exists($registeredPhotoPath)) {
                    \Log::error('Registered face photo not found', ['path' => $registeredPhotoPath]);
                    return redirect()->back()->with('error', 'Foto wajah Anda tidak ditemukan. Silakan daftarkan ulang wajah Anda.');
                }
                
                $registeredPhotoData = base64_encode(Storage::disk('public')->get($registeredPhotoPath));
        
                // API Key dan Secret Face++
                $apiKey = 'HGnUFFwOfHMy8_TZ5GP1BZ3sglmJ-uy0';
                $apiSecret = 'NzETb4zN3FHKZv-bGGJzaIcPzm-HACWz';
        
                // URL API Face++ untuk membandingkan wajah
                $url = 'https://api-us.faceplusplus.com/facepp/v3/compare';
        
                // Mengirim permintaan ke API Face++ untuk membandingkan wajah
                try {
                    $client = new Client([
                        'timeout' => 30, // Increase timeout to 30 seconds
                    ]);
                    
                    $response = $client->post($url, [
                        'form_params' => [
                            'api_key' => $apiKey,
                            'api_secret' => $apiSecret,
                            'image_base64_1' => base64_encode($imageData),  // Foto wajah yang diambil saat absensi
                            'image_base64_2' => $registeredPhotoData,  // Foto wajah yang tersimpan
                        ]
                    ]);
        
                    // Ambil hasil dari Face++
                    $data = json_decode($response->getBody(), true);
                    
                    // Log API response for debugging
                    \Log::info('Face++ API response', $data);
                    
                    // Check if the API returned the expected data
                    if (!isset($data['confidence'])) {
                        \Log::error('Face++ API did not return confidence value', $data);
                        return redirect()->back()->with('error', 'Gagal memverifikasi wajah. Silakan coba lagi.');
                    }
                    
                    $confidence = $data['confidence'];
                } catch (\Exception $e) {
                    \Log::error('Face++ API error', ['error' => $e->getMessage()]);
                    
                    // Even if API verification fails, we'll still save the attendance data
                    // but with lower confidence
                    $confidence = 0;
                }
        
                // Cek apakah hasil verifikasi wajah sesuai dengan threshold (misalnya 80%)
                $status = ($confidence >= 80) ? 'hadir' : 'ditolak';
        
                // Always save the attendance record with whatever data we have
                $absence = $user->absensi()->create([
                    'meeting_id' => $request->meeting_id,
                    'tanggal_absen' => $request->tanggal_absen, // Ambil dari input hidden
                    'status' => $status,
                    'confidence' => $confidence,
                    'foto' => $filePath,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude
                ]);
        
                // Log the created absence record
                \Log::info('Absence record created', [
                    'id' => $absence->id,
                    'status' => $status,
                    'confidence' => $confidence
                ]);
        
                if ($status === 'hadir') {
                    return redirect()->back()->with('success', 'Absensi berhasil dikirim.');
                } else {
                    return redirect()->back()->with('warning', 'Verifikasi wajah gagal, namun data absensi tetap disimpan untuk ditinjau.');
                }
            }
                
        } catch (\Exception $e) {
            \Log::error('Exception in processAbsence', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

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

    // Pastikan status adalah "Hadir" dan verifikasi wajah sudah sukses
    if ($validatedData['status'] === 'Hadir' && !$request->session()->get('face_verified')) {
        return redirect()->back()->with('error', 'Verifikasi wajah gagal. Coba lagi.');
    }

    // Simpan absensi
    Absensi::create([
        'user_id' => auth()->user()->id, // Pengguna yang sedang login
        'meeting_id' => $meeting, // ID pertemuan
        'tanggal_absen' => $validatedData['tanggal_absen'],
        'status' => $validatedData['status'],
    ]);

    return redirect()->back()->with('success', 'Absensi berhasil dikirim.');
}


}
