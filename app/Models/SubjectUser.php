<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectUser extends Model
{
    use HasFactory;

    protected $table = 'subject_users';

    protected $fillable = ['user_id', 'subject_id'];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke model Subject
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
