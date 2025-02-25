<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class ViewBlogController extends Controller
{
    // Fungsi untuk menampilkan halaman blog berdasarkan ID
    public function show($id)
    {
        $blog = Blog::findOrFail($id); // Cari blog berdasarkan ID
$otherBlogs = Blog::where('id', '!=', $id)->limit(5)->get();

        // Return view ke folder 'view/blog/index.blade.php' dengan data blog
        return view('blog.index', compact('blog','otherBlogs'));
    }
}
