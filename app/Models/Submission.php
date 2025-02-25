<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    // Specify the fillable fields
    protected $fillable = [
        'tugas_id',
        'user_id',
        'judul',
        'deskripsi',
        'file',
    ];

    // Define the relationship with Tugas
    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'tugas_id');
    }

    // Define the relationship with User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function siswa()
    {
        return $this->belongsTo(User::class, 'user_id');  // Setiap pengumpulan milik satu siswa
    }

    public function score()
    {
        return $this->hasOne(Score::class, 'submission_id');
    }


}
