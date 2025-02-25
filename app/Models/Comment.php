<?php

// app/Models/Comment.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    protected $fillable = ['user_id', 'comment', 'parent_id'];

    // Relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship for replies
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // Relationship for parent comment
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}