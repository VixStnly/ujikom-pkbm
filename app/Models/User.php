<?php

// app/Models/User.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'nisn_nip',
        'profile_image',
        // Add this line
    ];



    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Relasi ke kelas sebagai guru
    public function kelasDiaajar()
    {
        return $this->hasMany(Kelas::class, 'user_id');
    }

    // Relasi ke kelas sebagai siswa
    public function kelasDiikuti()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_siswa', 'siswa_id', 'kelas_id');
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    // Di User.php
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class, 'user_id');
    }
    public function submissionsTugas()
    {
        return $this->hasMany(Submission::class, 'tugas_id');
    }

    public function enrolledSubjects()
    {
        return $this->belongsToMany(Subject::class);
    }


    public function guru()
    {
        return $this->belongsToMany(User::class, 'user_guru', 'user_id', 'guru_id');
    }
    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_user', 'user_id', 'kelas_id');
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_user', 'user_id', 'subject_id');
    }
    public function materi()
    {
        return $this->hasMany(Materi::class);
    }
    public function tugasDibuat()
    {
        return $this->hasMany(Tugas::class);  // Guru membuat banyak tugas
    }

    public function showSiswa()
    {
        // Mendapatkan semua siswa
        $siswa = User::where('role', 'siswa')->get();

        // Mengirim data siswa ke view
        return view('dashboard.guru', compact('siswa'));
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }

    public function meetings()
    {
        return $this->belongsToMany(Meeting::class, 'meeting_user'); // Jika ada pivot user-meeting
    }

    // Relasi ke Absensi
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'user_id');
    }

    // Fungsi untuk mendapatkan role, jika role disimpan di kolom role
    public function isAdmin()
    {
        return $this->role_id === 1; // Adjust based on your admin role ID
    }


}
