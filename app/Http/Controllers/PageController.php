<?php

// app/Http/Controllers/PageController.php
namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\Jurusan;
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

    public function jurusan()
    {
        // Use pagination so the view can call ->links() and ->hasPages()
        $jurusans = Jurusan::latest()->paginate(9);
        return view('pages.jurusan', compact('jurusans'));
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

    public function jurusanDetail($slug)
    {
        $jurusan = Jurusan::where('slug', $slug)->firstOrFail();
        return view('pages.jurusan-detail', compact('jurusan'));
    }
}
