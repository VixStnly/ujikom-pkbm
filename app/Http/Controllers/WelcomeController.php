<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Gallery;
use App\Models\Announcement;

class WelcomeController extends Controller
{
    public function showContent()
    {
        // Mengambil 3 blog terbaru dan 5 pengumuman terbaru dari database
        $blogs = Blog::with('user')->latest()->take(3)->get(); // Ambil 3 blog terbaru
        $announcements = Announcement::latest()->take(5)->get(); // Ambil 5 pengumuman terbaru
        $galleries = Gallery::latest()->take(7)->get(); 
        // Mengirimkan data ke view welcome.blade.php
        return view('welcome', compact( 'blogs', 'announcements','galleries'));
    }
    
    

}




