@extends('layouts.app')

@section('title', 'Produk Kami')

@section('content')
    <!-- Product Header -->
    <header class="bg-linear-to-r from-blue-600 to-blue-800 text-white py-16 px-4">
        <div class="container mx-auto max-w-6xl">
            <h1 class="text-3xl md:text-4xl font-bold mb-4">Produk Kami</h1>
            <p class="text-lg md:text-xl opacity-90">Temukan berbagai produk berkualitas dari kami.</p>
        </div>
    </header>

    <!-- Products Grid -->
    <main class="container mx-auto max-w-6xl px-4 py-12">
        <!-- Filter & Search (Optional) -->
        <div class="mb-8">
            <form action="" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Cari produk..."
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Cari
                </button>
            </form>
        </div>

        <!-- Products List -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($produks as $produk)
                <article class="bg-white rounded-lg shadow-md overflow-hidden group hover:shadow-xl transition-shadow duration-300">
                    @if($produk->gambar)
                        <div class="aspect-w-16 aspect-h-9 overflow-hidden">
                       <img src="{{ '/storage/' . $produk->gambar }}" 
                                 alt="{{ $produk->nama_produk }}"
                                 class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                    @endif
                    
                    <div class="p-6">
                        <h2 class="text-xl font-bold mb-3 text-gray-900">{{ $produk->nama_produk }}</h2>
                        
                        @php
                            $desc = trim(strip_tags($produk->deskripsi ?? ''));
                        @endphp
                        <div class="prose prose-sm text-gray-600 mb-4">
                            {{ $desc !== '' ? \Illuminate\Support\Str::limit($desc, 150) : 'Tidak ada deskripsi' }}
                        </div>

                        <!-- Optional: Add to Cart or Contact Button -->
                        <div class="mt-4 flex justify-between items-center">
                            <button 
                                onclick="window.location.href='{{ route('kontak') }}'"
                                class="inline-flex items-center px-4 py-2 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                Hubungi Kami
                            </button>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-12">
                    <div class="text-gray-500 mb-4">
                        <svg class="mx-auto h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Belum ada produk</h3>
                    <p class="mt-1 text-gray-500">Produk akan segera ditambahkan.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($produks->hasPages())
            <div class="mt-8">
                {{ $produks->links() }}
            </div>
        @endif
    </main>
@endsection
