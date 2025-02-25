<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriGaleri extends Model
{
    use HasFactory;

    protected $table = 'kategori_galeri';
    protected $fillable = [
        'name', // Add the name property here
        // Add other properties you want to be mass assignable
    ];
    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'kategori_id');
    }
}
