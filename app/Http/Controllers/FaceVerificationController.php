<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FaceVerificationController extends Controller
{
    
    public function verifyFace(Request $request)
    {
        // Validasi input foto
        $request->validate([
            'photo_data' => 'required|string',  // Foto yang dikirim dalam format base64
        ]);

        // Ambil gambar yang dikirimkan (format base64)
        $imageData = $request->input('photo_data');
        // Hapus bagian prefix data URL: 'data:image/png;base64,'
        $imageData = str_replace('data:image/png;base64,', '', $imageData);
        $imageData = base64_decode($imageData);

        // Simpan gambar wajah ke storage
        $facePhotoPath = 'face_photos/' . uniqid() . '.png';
        Storage::disk('public')->put($facePhotoPath, $imageData);

        // Simpan path foto wajah di kolom 'face_photo' di tabel users
        $user = Auth::user();
        $user->face_photo = $facePhotoPath;
        $user->save();

        return redirect()->back()->with('success', 'Wajah Berhasil di verifikasi.');
    }
}
