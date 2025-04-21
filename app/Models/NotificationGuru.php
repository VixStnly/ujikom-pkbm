<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationGuru extends Model
{
    protected $table = 'notifications_guru';

    protected $fillable = [
        'user_id',
        'tugas_id',
        'title',
        'message',
        'is_read',
    ];

    /**
     * Relasi ke model User (Guru penerima notifikasi)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Tugas
     */
    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }
}
