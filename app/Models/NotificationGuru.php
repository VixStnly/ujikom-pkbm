<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationGuru extends Model
{
    protected $table = 'notifications_guru';

    protected $fillable = [
        'user_id', 'title', 'message', 'is_read', 'created_at', 'updated_at',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
