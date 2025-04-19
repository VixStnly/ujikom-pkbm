<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    // Define the table name if it's not the plural form of the model name
    protected $table = 'absensi';

    // Define the fillable attributes
    protected $fillable = [
        'user_id',
        'meeting_id',
        'tanggal_absen',
        'status',
        'foto',
        'latitude',
        'longitude',
    ];

    // Define the relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Define the relationship to the Meeting model
    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
}
