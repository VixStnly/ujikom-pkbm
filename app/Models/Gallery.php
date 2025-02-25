<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'image', 
        'kategori_id', 
        // kolom lainnya
    ];

    // Relasi ke KategoriGaleri
    public function kategori()
    {
        return $this->belongsTo(KategoriGaleri::class, 'kategori_id');
    }
}
