<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural form of the model name
    protected $table = 'tasks';

    // Define the fillable fields to allow mass assignment
    protected $fillable = [
        'title',
        'description',
        'completed',
        'image',
        'user_id',
    ];

    // Define any relationships if needed
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
