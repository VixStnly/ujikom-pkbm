<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_id',
        'user_id',
        'judul',
        'deskripsi',
        'tanggal_deadline',
        'file_path',
        'link',
    ];

    protected $table = 'tugas';

    public function meeting()
    {
        return $this->belongsTo(Meeting::class, 'meeting_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class, 'tugas_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function submissionsTugas()
    {
        return $this->hasMany(Submission::class, 'tugas_id');
    }

    // Di model Tugas
    public function scopeUserTugas($query)
    {
        return $query->where('user_id', auth()->id());
    }

    // Di model Materi
    public function scopeUserMateri($query)
    {
        return $query->where('user_id', auth()->id());
    }


}