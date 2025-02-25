<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasUser extends Model
{
    use HasFactory;

    protected $fillable = ['id_kelas', 'user_id'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }
    public function subjects()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
