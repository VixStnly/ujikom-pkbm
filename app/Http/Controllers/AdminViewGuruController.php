<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Meeting;
use App\Models\Subject;
use App\Models\User;

class AdminViewGuruController extends Controller
{
    public function kelasGuru($id)
    {
        // Simpan ID guru ke session
        session(['view_as_guru_id' => $id]);

        // Redirect ke halaman guru kelas
        return redirect()->route('guru.kelas.index');
    }
}
