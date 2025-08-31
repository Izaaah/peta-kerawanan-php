<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;

class GaleriController extends Controller
{
    public function galeri_foto()
    {
        // Mengambil semua data gambar dari database
        $galeri = Galeri::all();  // Ambil semua data gambar dari database
        view()->share('galeri', $galeri);
        dd($galeri);
        // Mengirim data gambar ke view dengan compact
        return view('super-admin.dashboard', compact('galeri'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string|max:255', // Validasi untuk kolom description
        ]);

        $imagePath = $request->file('image')->store('images/gallery', 'public');

        // Simpan gambar dan deskripsi ke dalam database
        Galeri::create([
            'image_path' => $imagePath,
            'description' => $request->description, // Menyimpan deskripsi jika ada
        ]);

        return redirect()->route('super-admin.dashboard') . '#gallery-section';
    }
}
