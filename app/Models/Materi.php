<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_id',
        'user_id',
        'judul',
        'konten',
        'file_path',
        'link',
    ];

    protected $table = 'materi';

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    public function subjects()
    {
        return $this->belongsTo(Subject::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }


    public function kelas()
    {
        return $this->belongsTo(Kelas::class);  // Asumsinya 'materi' punya foreign key 'kelas_id'
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}