<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = ['grade', 'name'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'kelas_user');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'kelas_user', 'kelas_id', 'user_id')->where('role_id', 4);
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }
    public function subjects()
    {
        return $this->hasMany(Subject::class); // Adjust if your table/foreign key is different
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function materis()
    {
        return $this->hasMany(Materi::class);
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }
}
