<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;

class BlogsController extends Controller
{
    // Menampilkan semua blogs
    public function index()
    {
        $this->authorizeAccess(); // Memeriksa akses

        $blogs = Blog::with('user')->paginate(5); // Display 5 items per page
        $user = Auth::user();

        return view('admin.blogs.index', compact('blogs', 'user'));
    }
    public function landing()
    {

        $blogs = Blog::with('user')->paginate(5); // Display 5 items per page
        $user = Auth::user();

        return view('landing.Bloglist', compact('blogs', 'user'));
    }

    // Menampilkan form untuk membuat blog baru
    public function create()
    {
        $this->authorizeAccess(); // Memeriksa akses
        $user = Auth::user();

        return view('admin.blogs.create', compact('user'));
    }

    // Menyimpan blog baru
    public function store(Request $request)
    {
        $this->authorizeAccess(); // Memeriksa akses

        // Validate the request
        $request->validate([
            'title' => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'description' => 'required|string',
            'image' => 'image|nullable|max:20048', // Maximum image size of 2 MB
        ], [
            'title.required' => 'Judul harus diisi.',
            'title.regex' => 'Judul hanya boleh mengandung huruf dan spasi.',
            'description.required' => 'Deskripsi harus diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.max' => 'Gambar harus maksimal 2MB.',
        ]);

        // Upload image if exists
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->file('image')->storeAs('public/blog', $imageName);
        }

        // Create the blog
        Blog::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog Berhasil Dibuat.');
    }

    // Menampilkan blog spesifik
    public function show(Blog $blog)
    {
        $this->authorizeAccess(); // Memeriksa akses
        $user = Auth::user();

        return view('admin.blogs.show', compact('blog', 'user'));
    }

    
    // Menampilkan form untuk mengedit blog
    public function edit(Blog $blog)
    {
        $this->authorizeAccess(); // Memeriksa akses
        $user = Auth::user();

        return view('admin.blogs.edit', compact('blog', 'user'));
    }

    // Update blog
    public function update(Request $request, Blog $blog)
    {
        $this->authorizeAccess(); // Memeriksa akses

        // Validate the request
        $request->validate([
            'title' => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'description' => 'required|string',
            'image' => 'image|nullable|max:20048', // Ukuran maksimum gambar 2 MB
        ], [
            'title.required' => 'Judul harus diisi.',
            'title.regex' => 'Judul hanya boleh mengandung huruf dan spasi.',
            'description.required' => 'Deskripsi harus diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.max' => 'Gambar harus maksimal 2MB.',
        ]);

        // Check if a new image is uploaded
        $imageName = $blog->image; // Default to the existing image

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($imageName) {
                Storage::delete('public/blog/' . $imageName); // Delete old image
            }

            // Upload new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/blog', $imageName);
        }

        // Update the blog
        $blog->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Edit Blog Berhasil.');
    }

    // Hapus blog
    public function destroy(Blog $blog)
    {
        $this->authorizeAccess(); // Memeriksa akses

        // Delete image if it exists
        if ($blog->image) {
            $imagePath = 'public/blog/' . $blog->image;
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath); // Delete image
            }
        }

        // Delete the blog record from the database
        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Hapus Blog Berhasil');
    }

    // Authorize access based on user role
    protected function authorizeAccess()
    {
        $user = Auth::user();

        // Memeriksa apakah pengguna memiliki role_id 1 atau 2
        if (!$user || !in_array($user->role_id, [1, 2])) {
            abort(redirect('/akses'));

        }
    }
}
