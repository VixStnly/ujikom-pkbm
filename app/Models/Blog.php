<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image', 'user_id'];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
