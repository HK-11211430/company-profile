@extends('layouts.app')

@section('title', 'Artikel Kami')

@section('content')
    <!-- Header Section -->
    <div class="bg-linear-to-r from-blue-600 to-blue-700 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-white text-center">Artikel Kami</h1>
            <p class="mt-4 text-xl text-blue-100 text-center max-w-3xl mx-auto">
                Temukan wawasan, tips, dan berita terbaru dari tim kami
            </p>
        </div>
    </div>

    <!-- Articles Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($artikels as $item)
                <article class="bg-white rounded-lg shadow-lg overflow-hidden transition duration-300 hover:shadow-xl hover:-translate-y-1">
                    <!-- Article Image -->
                    <div class="aspect-w-16 aspect-h-9 relative">
                            <img 
                                src="{{ '/storage/' . $item->thumbnail }}" 
                            alt="{{ $item->judul }}"
                            class="object-cover w-full h-48"
                        >
                    </div>

                    <!-- Article Content -->
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-2 line-clamp-2 hover:text-blue-600">
                            {{ $item->judul }}
                        </h2>

                        <!-- Meta Info -->
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>{{ $item->user->name }}</span>
                            <span class="mx-2">&bull;</span>
                            <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>{{ $item->created_at->format('d M Y') }}</span>
                        </div>

                        <!-- Read More Button -->
                        <a 
                            href="{{ route('artikel.detail', $item->slug) }}"
                            class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700"
                        >
                            Baca Selengkapnya
                            <svg class="ml-2 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </article>
            @empty
                <div class="col-span-full py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada artikel</h3>
                    <p class="mt-2 text-gray-500">Artikel akan segera hadir. Silakan kembali lagi nanti.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $artikels->links() }}
        </div>
    </div>
@endsection