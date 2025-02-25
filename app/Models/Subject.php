<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'user_id',
        // Tambahkan kolom lain jika perlu
    ];

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
// In Subject.php (Subject Model)
public function users()
{
    return $this->belongsToMany(User::class, 'subject_user', 'subject_id', 'user_id');
}



    public function materi()
    {
        return $this->hasMany(Materi::class);
    }

    public function subject_user()
    {
        return $this->belongsToMany(User::class, 'subject_user', 'subject_id', 'user_id');
    }
    

    public function materis()
    {
        return $this->hasMany(Materi::class);
    }


    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
