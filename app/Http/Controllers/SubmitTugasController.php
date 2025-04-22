<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use ZipArchive;
use App\Models\Tugas;
use App\Models\Submission;
use App\Models\NotificationGuru;
use App\Models\Score;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class SubmitTugasController extends Controller
{
    public function downloadAllFiles($user_id)
    {
        $this->authorizeAccess(); // Memeriksa akses

        // Retrieve all submissions for the user
        $submissions = Submission::where('user_id', $user_id)->get();

        // Create a new zip file
        $zip = new ZipArchive();
        $zipFileName = 'submissions_' . $user_id . '.zip';
        $zipPath = storage_path($zipFileName);

        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            return response()->json(['message' => 'Could not create zip file.'], 500);
        }

        // Add each file to the zip
        foreach ($submissions as $submission) {
            $filePath = storage_path('app/public/' . $submission->file);
            if (file_exists($filePath)) {
                $zip->addFile($filePath, basename($submission->file));
            }
        }

        // Close the zip file
        $zip->close();

        // Return the zip file as a download response
        return response()->download($zipPath)->deleteFileAfterSend(true);
    }

    public function show($id)
    {
        $this->authorizeAccess(); // Memeriksa akses

        // Get the task details
        $user = Auth::user(); // Ambil data pengguna yang sedang login

        $tugas = Tugas::with('guru')->findOrFail($id);

        // Check if the user has submitted the task
        $submission = Submission::where('user_id', auth()->id())
            ->where('tugas_id', $id)
            ->first();

        // Retrieve all submissions for the user for this task
        $submissions = Submission::where('user_id', auth()->id())
            ->where('tugas_id', $id)
            ->get();

        // Get the score if the task is submitted
        $score = $submission ? Score::where('submission_id', $submission->id)->first() : null;

        return view('siswa.tugas.submit', compact('tugas', 'submission', 'score', 'submissions','user'));
    }

    
    public function store(Request $request, $id)
    {
        $this->authorizeAccess(); // Memeriksa akses

        // Validate the request with custom messages
        $request->validate([
            'judul' => 'required|string|max:255', // Add validation for title
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx', // Add acceptable file types
            'description' => 'nullable|string', // Make description optional
        ], [
            'judul.required' => 'Judul tugas harus diisi.',
            'judul.string' => 'Judul harus berupa teks.',
            'judul.max' => 'Judul tidak boleh lebih dari 255 karakter.',
            'file.required' => 'File tugas harus diunggah.',
            'file.file' => 'File yang diunggah tidak valid.',
            'file.mimes' => 'File harus berupa jenis: pdf, jpg, jpeg, png, doc, docx.',
            'description.string' => 'Deskripsi harus berupa teks.',
        ]);

        // Handle file upload and save to the submissions table
        $filePath = $request->file('file')->store('uploads', 'public');

        Submission::create([
            'tugas_id' => $id,
            'user_id' => auth()->id(),
            'judul' => $request->judul, // Use the title from the input
            'deskripsi' => $request->description,
            'file' => $filePath,
        ]);

        $tugas = Tugas::find($id);
        $siswa = auth()->user(); // <== ini penting
        
        $guruId = $tugas->user_id;

        NotificationGuru::create([
            'user_id' => $guruId,
            'tugas_id' => $id,
            'title' => 'Tugas Baru',
            'message' => $siswa->name . ' mengirim tugas pada "' . $tugas->judul . '"',
            'is_read' => false,
        ]);
        return redirect()->back()->with('success', 'Tugas berhasil disubmit.');
    }

    public function getScore($id)
    {
        $this->authorizeAccess(); // Memeriksa akses

        $submission = Submission::find($id);
        
        if ($submission && $submission->score) {
            return response()->json([
                'success' => true,
                'score' => [
                    'nilai' => $submission->score->nilai,
                    'keterangan' => $submission->score->keterangan,
                ],
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Nilai tidak ditemukan atau belum dinilai.',
        ]);
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
