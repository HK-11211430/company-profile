<?php

// app/Http/Controllers/PageController.php
namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\Produk;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        // Ambil 3 artikel terbaru yang sudah 'published'
        $latestArtikels = Artikel::where('status', 'published')
            ->with('user')
            ->latest()
            ->take(3)
            ->get();
        return view('pages.home', compact('latestArtikels'));
    }

    public function produk()
    {
        // Use pagination so the view can call ->links() and ->hasPages()
        $produks = Produk::latest()->paginate(9);
        return view('pages.produk', compact('produks'));
    }

    public function artikel()
    {
        $artikels = Artikel::where('status', 'published')
            ->with('user')
            ->latest()
            ->paginate(9); // Gunakan paginasi
        return view('pages.artikel', compact('artikels'));
    }

    public function artikelDetail($slug)
    {
        $artikel = Artikel::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail(); // Cari berdasarkan slug
        return view('pages.artikel-detail', compact('artikel'));
    }

    public function galeri()
    {
        $galeris = Galeri::latest()->paginate(9);
        return view('pages.galeri', compact('galeris'));
    }

    public function galeriDetail($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('pages.galeri-detail', compact('galeri'));
        return view('pages.galeri', compact('galeris'));
    }

    public function kontak()
    {
        return view('pages.kontak');
    }
}
