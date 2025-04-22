<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'message',
        'icon',
        'icon_color',
        'is_read',
        'subject_id',
    
    ];
    public function subject()
{
    return $this->belongsTo(User::class, 'subject_id');
}
public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
