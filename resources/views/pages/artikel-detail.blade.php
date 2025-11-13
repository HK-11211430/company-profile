@extends('layouts.app')

@section('title', $artikel->judul)

@section('content')
    <!-- Article Header -->
    <article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Breadcrumb -->
        <nav class="flex items-center text-sm text-gray-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-gray-700">Beranda</a>
            <svg class="h-4 w-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <a href="{{ route('artikel') }}" class="hover:text-gray-700">Artikel</a>
            <svg class="h-4 w-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-gray-900">{{ $artikel->judul }}</span>
        </nav>

        <!-- Article Title -->
        <h1 class="text-4xl font-bold text-gray-900 mb-4">
            {{ $artikel->judul }}
        </h1>

        <!-- Article Meta -->
        <div class="flex items-center space-x-4 text-sm text-gray-500 mb-8">
            <div class="flex items-center">
                <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>{{ $artikel->user->name }}</span>
            </div>
            <div class="flex items-center">
                <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <time datetime="{{ $artikel->created_at->format('Y-m-d') }}">
                    {{ $artikel->created_at->format('d M Y') }}
                </time>
            </div>
        </div>

        <!-- Article Image -->
        <div class="relative rounded-lg overflow-hidden mb-8 aspect-w-16 aspect-h-9">
            <img 
                src="{{ '/storage/' . $artikel->thumbnail }}" 
                alt="{{ $artikel->judul }}"
                class="object-cover w-full h-full"
            >
        </div>

        <!-- Article Content -->
        <div class="prose prose-lg max-w-none">
            {!! $artikel->konten !!}
        </div>

        <!-- Share Buttons -->
        <div class="mt-12 pt-6 border-t border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Bagikan artikel ini:</h3>
            <div class="flex space-x-4">
                <!-- Facebook -->
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    Facebook
                </a>

                <!-- Twitter -->
                <a href="https://twitter.com/intent/tweet?text={{ urlencode($artikel->judul) }}&url={{ urlencode(request()->url()) }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-400 hover:bg-blue-500">
                    <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                    </svg>
                    Twitter
                </a>

                <!-- WhatsApp -->
                <a href="https://wa.me/?text={{ urlencode($artikel->judul . ' ' . request()->url()) }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                    <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    WhatsApp
                </a>
            </div>
        </div>
    </article>

    <!-- Related Articles -->
    <div class="bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Artikel Terkait</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach(\App\Models\Artikel::where('id', '!=', $artikel->id)
                                ->where('status', 'published')
                                ->inRandomOrder()
                                ->take(3)
                                ->get() as $relatedArticle)
                    <a href="{{ route('artikel.detail', $relatedArticle->slug) }}" 
                       class="block bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition duration-300">
                        <img 
                            src="{{ '/storage/' . $relatedArticle->thumbnail }}" 
                            alt="{{ $relatedArticle->judul }}"
                            class="w-full h-40 object-cover"
                        >
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 line-clamp-2">
                                {{ $relatedArticle->judul }}
                            </h3>
                            <time class="text-sm text-gray-500" datetime="{{ $relatedArticle->created_at->format('Y-m-d') }}">
                                {{ $relatedArticle->created_at->format('d M Y') }}
                            </time>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection