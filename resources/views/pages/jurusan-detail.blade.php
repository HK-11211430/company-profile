@extends('layouts.app')

@section('title', $jurusan->nama_jurusan)

@section('content')
    <article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <nav class="flex items-center text-sm text-gray-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-gray-700">Beranda</a>
            <svg class="h-4 w-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <a href="{{ route('jurusan') }}" class="hover:text-gray-700">Jurusan</a>
            <svg class="h-4 w-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-gray-900">{{ $jurusan->nama_jurusan }}</span>
        </nav>

        <h1 class="text-3xl md:text-4xl font-bold mb-4">{{ $jurusan->nama_jurusan }}</h1>

        @if(!empty($jurusan->harga))
            <p class="text-xl text-indigo-600 font-semibold mb-4">
                Biaya: Rp {{ number_format($jurusan->harga, 0, ',', '.') }}
            </p>
        @endif

        @if($jurusan->gambar)
            <div class="relative rounded-lg overflow-hidden mb-8 aspect-w-16 aspect-h-9">
                <img 
                    src="{{ '/storage/' . $jurusan->gambar }}" 
                    alt="{{ $jurusan->nama_jurusan }}"
                    class="object-cover w-full h-full"
                >
            </div>
        @endif

        <div class="prose prose-lg max-w-none mb-6">
            {!! $jurusan->deskripsi ?? 'Tidak ada deskripsi' !!}
        </div>

        <div class="flex flex-wrap gap-3 mt-6">
            <a href="{{ route('kontak') . '?subject=' . urlencode('Daftar ' . $jurusan->nama_jurusan) }}"
               class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                Daftar Sekarang
            </a>

            <a href="{{ route('kontak') . '?subject=' . urlencode('Pertanyaan tentang ' . $jurusan->nama_jurusan) }}"
               class="inline-flex items-center px-4 py-2 border border-indigo-600 text-indigo-600 rounded-lg hover:bg-indigo-600 hover:text-white transition-colors duration-200">
                Hubungi Kami
            </a>
        </div>
    </article>
@endsection
