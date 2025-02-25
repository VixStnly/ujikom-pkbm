<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = ['submission_id', 'nilai', 'keterangan', 'user_id'];

    public function submissionsTugas()
    {
        return $this->hasMany(Submission::class, 'tugas_id');
    }

    public function submission()
    {
        return $this->belongsTo(Submission::class, 'submission_id');
    }
}
