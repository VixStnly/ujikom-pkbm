<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotifMessage extends Model
{
    protected $table = 'notif_message';

    protected $fillable = [
        'user_id',
        'type',
        'data',
        'is_read',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
