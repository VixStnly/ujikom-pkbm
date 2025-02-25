<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    // app/Models/Comment.php
public function replies()
{
    return $this->hasMany(Reply::class);
}

// app/Models/Reply.php
public function comment()
{
    return $this->belongsTo(Comment::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}

}
