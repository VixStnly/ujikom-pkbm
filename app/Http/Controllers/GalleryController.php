<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\KategoriGaleri;
use Illuminate\Http\Exceptions\HttpResponseException;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $this->authorizeAccess(); // Memeriksa akses
    
        $user = Auth::user();
    
        $query = Gallery::query();
    
        // Filter by kategori_id if provided
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }
    
        // Use paginate instead of get to paginate results
        $galleries = $query->paginate(6); // Display 6 items per page
    
        $categories = KategoriGaleri::all(); // Adjust this line based on how you fetch categories
    
        return view('admin.galleries.index', compact('galleries', 'categories', 'user'));
    }
    

    public function create()
    {
        $this->authorizeAccess(); // Memeriksa akses
        $user = Auth::user();
        $categories = KategoriGaleri::all(); // Mengambil semua kategori dari tabel kategori galeri

        // Show the form for creating a new gallery image
        return view('admin.galleries.create', compact('user', 'categories'));
    }

    public function store(Request $request)
    {
        $this->authorizeAccess(); // Memeriksa akses

        // Validasi permintaan yang masuk
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:20480',
            'kategori_id' => 'required|exists:kategori_galeri,id', // Validasi kategori_id
        ]);

        // Simpan gambar dan buat entri galeri baru
        $path = $request->file('image')->store('gallery', 'public');
        Gallery::create([
            'image' => $path,
            'kategori_id' => $request->kategori_id, // Menyimpan kategori_id
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Image uploaded successfully.');
    }
    public function showCategories()
    {
        // Fetch all categories
        $user = Auth::user();

        $categories = KategoriGaleri::all(); // Ensure this is fetching the right data
    
        return view('galeri.categories', compact('categories','user'));
    }
    
    public function showAlbum($kategori_id)
    {
        // Retrieve all gallery images that belong to the specified kategori_id
        $galleries = Gallery::where('kategori_id', $kategori_id)->get();
        $category = KategoriGaleri::findOrFail($kategori_id); // Get the category name
    
        return view('galeri.album', compact('galleries', 'category'));
    }
    
    public function edit($id)
    {
        $this->authorizeAccess(); // Memeriksa akses
        $user = Auth::user();

        // Retrieve the specific gallery entry by ID
        $gallery = Gallery::findOrFail($id); // This fetches a single instance
        $categories = KategoriGaleri::all(); // Retrieve all categories
        return view('admin.galleries.edit', compact('gallery', 'user', 'categories')); // Pass categories to the view
    }

    public function update(Request $request, Gallery $gallery)
    {
        $this->authorizeAccess(); // Memeriksa akses

        // Validate the incoming request
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480', // Nullable since the user may not want to change the image
            'kategori_id' => 'required|exists:kategori_galeri,id', // Validate kategori_id
        ]);

        // Check if a new image has been uploaded
        if ($request->hasFile('image')) {
            // Delete the old image from storage
            Storage::disk('public')->delete($gallery->image);

            // Store the new image
            $path = $request->file('image')->store('gallery', 'public');
            $gallery->update(['image' => $path]);
        }

        // Update the kategori_id
        $gallery->update(['kategori_id' => $request->kategori_id]);

        return redirect()->route('admin.gallery.index')->with('success', 'Image and category updated successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        $this->authorizeAccess(); // Memeriksa akses

        // Delete the image file from storage
        Storage::disk('public')->delete($gallery->image);
        
        // Delete the gallery entry
        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Image deleted successfully.');
    }

    protected function authorizeAccess()
    {
        $user = Auth::user();

        // Memeriksa apakah pengguna memiliki role_id 1 atau 2
        if (!$user || !in_array($user->role_id, [1, 2])) {
            abort(redirect('/akses'));

        }
    }
}
