<?php
// app/Models/Course.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'feature_1',
        'feature_2',
        'feature_3',
        'feature_4',
        'feature_5',
        'duration',
        'category',
    ];

    protected $table = 'courses'; // Pastikan nama tabel sesuai dengan database kamu
    // Atur properti lain yang diperlukan

    public function materi()
    {
        return $this->hasMany(Materi::class);
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }

}
