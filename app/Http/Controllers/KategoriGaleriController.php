<?php

namespace App\Http\Controllers;
use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;
use App\Models\KategoriGaleri;
use Illuminate\Http\Request;

class KategoriGaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        return view('admin.galleries.kategori.create',compact ('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        KategoriGaleri::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Kategori berhasil ditambahkan.');
    }
}
