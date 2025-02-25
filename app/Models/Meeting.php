<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'user_id',
        'title', // Misalnya, nama pertemuan
        'meeting_time', // Misalnya, nama pertemuan
        'description', // Misalnya, nama pertemuan
    ];

    public function materi()
    {
        return $this->hasMany(Materi::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function absensi()
    {
        return $this->hasMany(Absensi::class); // This assumes the Absensi model has a meeting_id foreign key
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function guru()
    {
        return $this->belongsToMany(User::class, 'subject_user', 'subject_id', 'user_id')
            ->withPivot('subject_id'); // Menghubungkan dengan user melalui pivot table
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }


    public function reports()
    {
        return $this->hasMany(Report::class);
    }


    public function getFormattedMeetingTimeAttribute()
    {
        return \Carbon\Carbon::parse($this->meeting_time)->format('l, d F Y '); // Contoh: "Jumat, 27 September 2024 15:00"
    }

}