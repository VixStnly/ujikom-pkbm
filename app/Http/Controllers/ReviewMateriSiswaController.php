<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Materi; // Include the model you are using
use Illuminate\Http\Request;

class ReviewMateriSiswaController extends Controller
{
    public function show($id)
    {
        $this->authorizeAccess(); // Memeriksa akses

        $user = Auth::user(); // Ambil data pengguna yang sedang login

        // Logic to fetch the material based on the ID
        $materi = Materi::findOrFail($id);

        // Return the view with the material data
        return view('siswa.materi.ReviewMateri', compact('materi','user'));
    }
    public function download($id)
{
    $this->authorizeAccess(); // Memeriksa akses

    $materi = Materi::findOrFail($id);

    $filePath = public_path($materi->file_path);
    return response()->download($filePath);
}

protected function authorizeAccess()
{
    $user = Auth::user();

    // Memeriksa apakah pengguna memiliki role_id 1 atau 2
    if (!$user || !in_array($user->role_id, [4])) {
        throw new HttpResponseException(response()->json([
            'error' => 'Unauthorized access'
        ], 403));
    }
}
}
