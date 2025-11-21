@extends('layouts.app')

@section('title', 'Galeri Kami')

@section('content')
    <!-- Header Section -->
    <div class="bg-linear-to-r from-blue-600 to-blue-700 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-white text-center">Galeri Kami</h1>
            <p class="mt-4 text-xl text-blue-100 text-center max-w-3xl mx-auto">
                Koleksi momen dan karya terbaik dalam gambar
            </p>
        </div>
    </div>

    <!-- Gallery Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($galeris as $item)
                <article class="bg-white rounded-lg shadow-lg overflow-hidden transition duration-300 hover:shadow-xl hover:-translate-y-1">
                    <a href="{{ route('galeri.detail', $item->id) }}" class="block">
                        <!-- Gallery Image (render directly to avoid overlay issues) -->
                        <div class="aspect-w-16 aspect-h-9 overflow-hidden">
                            @if($item->cover_image_url)
                                <img 
                                    src="{{ $item->cover_image_url }}" 
                                    alt="{{ $item->judul }}"
                                    class="object-cover w-full h-48 transform transition-transform duration-300 hover:scale-105"
                                >
                            @else
                                <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-500 text-sm">
                                    Tidak ada foto
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600">
                                {{ $item->judul }}
                            </h2>

                            <!-- Description (strip HTML and show fallback if empty) -->
                            @php
                                $desc = trim(strip_tags($item->deskripsi_singkat ?? ''));
                            @endphp
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ $desc !== '' ? $desc : 'Tidak ada deskripsi' }}
                            </p>

                            <!-- Meta Info -->
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ $item->created_at->format('d M Y') }}</span>

                                <span class="inline-flex items-center gap-1 text-xs font-medium text-blue-600">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    </svg>
                                    {{ $item->gambar_count }} foto
                                </span>
                            </div>
                        </div>
                    </a>
                </article>
            @empty
                <div class="col-span-full py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada foto di galeri</h3>
                    <p class="mt-2 text-gray-500">Galeri akan segera diperbarui. Silakan kembali lagi nanti.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $galeris->links() }}
        </div>
    </div>
@endsection

