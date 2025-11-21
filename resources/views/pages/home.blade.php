@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
	{{-- Article Slider --}}
	@php
		$artikelSlider = \App\Models\Artikel::where('status', 'published')->latest()->take(6)->get();
	@endphp
	
	@if($artikelSlider->count() > 0)
		<section class="mt-12">
		
			<div x-data="{
				activeSlide: 0,
				slides: [{{ implode(', ', $artikelSlider->map(function($a) { return "{ id: $a->id, img: '/storage/" . ($a->thumbnail ?? '') . "', title: '" . addslashes($a->judul) . "', desc: '" . addslashes(\Illuminate\Support\Str::limit(strip_tags($a->konten), 80)) . "', link: '" . route('artikel.detail', $a->slug) . "' }"; })->toArray()) }}],
				interval: null,
				startAutoSlide() {
					this.interval = setInterval(() => {
						this.activeSlide = (this.activeSlide + 1) % this.slides.length;
					}, 3000);
				},
				stopAutoSlide() {
					clearInterval(this.interval);
					this.interval = null;
				}
			}"
				x-init="startAutoSlide()"
				@mouseenter="stopAutoSlide()"
				@mouseleave="startAutoSlide()"
				class="relative">
				
				<!-- Main Slider -->
				<div class="relative h-96 md:h-[500px] rounded-lg overflow-hidden bg-gray-900">
					<template x-for="(slide, index) in slides" :key="index">
						<div x-show="activeSlide === index" 
							x-transition:enter="transition ease-out duration-300"
							x-transition:leave="transition ease-in duration-300"
							class="absolute inset-0">
							<img :src="slide.img" :alt="slide.title" class="w-full h-full object-cover">
							<div class="absolute inset-0 bg-linear-to-t from-black via-transparent to-transparent"></div>
							<div class="absolute bottom-0 left-0 right-0 p-6 md:p-8 text-white">
								<h3 class="text-2xl md:text-3xl font-bold mb-2" x-text="slide.title"></h3>
								<p class="text-sm md:text-base text-gray-200 mb-4" x-text="slide.desc"></p>
								<a :href="slide.link" class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg font-medium transition-colors">
									Baca Selengkapnya
								</a>
							</div>
						</div>
					</template>

					<!-- Navigation Buttons -->
					<button @click="activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1" 
						class="absolute left-4 top-1/2 transform -translate-y-1/2 z-10 bg-white bg-opacity-50 hover:bg-opacity-75 text-gray-900 p-2 rounded-full transition-all">
						<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
						</svg>
					</button>
					
					<button @click="activeSlide = (activeSlide + 1) % slides.length" 
						class="absolute right-4 top-1/2 transform -translate-y-1/2 z-10 bg-white bg-opacity-50 hover:bg-opacity-75 text-gray-900 p-2 rounded-full transition-all">
						<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
						</svg>
					</button>
				</div>

				<!-- Indicator Dots -->
				<div class="flex justify-center gap-2 mt-4">
					<template x-for="(slide, index) in slides" :key="index">
						<button @click="activeSlide = index" 
							:class="activeSlide === index ? 'bg-blue-600 w-8' : 'bg-gray-300 w-2'"
							class="h-2 rounded-full transition-all duration-300"></button>
					</template>
				</div>

				<!-- Auto-play script -->
				<script>
					setInterval(function() {
						document.querySelector('[x-data*="activeSlide"]').__x.$data.activeSlide = 
							(document.querySelector('[x-data*="activeSlide"]').__x.$data.activeSlide + 1) % 
							document.querySelector('[x-data*="activeSlide"]').__x.$data.slides.length;
					}, 3000);
				</script>
			</div>
		</section>
	@endif

	<section class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-6">
		<div class="bg-white rounded-lg p-6 shadow-sm">
			<h3 class="text-xl font-semibold text-gray-900">Jurusan Berkualitas</h3>
			<p class="mt-2 text-gray-600">Kami Memiliki 3 Jurusan dengan standar mutu industri yang dapat diandalkan.</p>
		</div>
		<div class="bg-white rounded-lg p-6 shadow-sm">
			<h3 class="text-xl font-semibold text-gray-900">Layanan Profesional</h3>
			<p class="mt-2 text-gray-600">Guru-Guru Kami Memiliki Pengalaman dan Keahlian yang dibutuhkan oleh industri.</p>
		</div>
		<div class="bg-white rounded-lg p-6 shadow-sm">
			<h3 class="text-xl font-semibold text-gray-900">Alumni Tersebar Luas</h3>
			<p class="mt-2 text-gray-600">Jaringan alumni kami yang luas siap membantu Anda dalam setiap langkah.</p>
		</div>
	</section>

	{{-- Highlight Slider (gabungkan Artikel & Galeri) --}}
	@php
		// Pastikan variable galeris tersedia untuk slider
		$galeris = \App\Models\Galeri::latest()->take(6)->get();
	@endphp
	@php
		$sliderArticles = collect();
		foreach($latestArtikels->take(4) as $a) {
			$img = $a->thumbnail && file_exists(public_path('storage/' . $a->thumbnail)) ? '/storage/' . $a->thumbnail : null;
			if ($img) {
				$sliderArticles->push([
					'img' => $img,
					'title' => $a->judul,
					'desc' => \Illuminate\Support\Str::limit(strip_tags($a->konten), 120),
					'link' => route('artikel.detail', $a->slug),
				]);
			}
		}

		$sliderGaleris = collect();
		foreach($galeris->take(4) as $g) {
			$img = $g->cover_image_url;
			if ($img) {
				$sliderGaleris->push([
					'img' => $img,
					'title' => $g->judul,
					'desc' => \Illuminate\Support\Str::limit(strip_tags($g->deskripsi_singkat), 120),
					'link' => route('galeri.detail', $g->id),
				]);
			}
		}
	@endphp


	{{-- Jurusan Terbaru --}}
	@php
		$jurusans = \App\Models\Jurusan::latest()->take(6)->get();
	@endphp
	<section class="mt-12">
		<div class="flex items-center justify-between mb-4">
			<h2 class="text-2xl font-bold">Jurusan</h2>
			<a href="{{ route('jurusan') }}" class="text-blue-600 hover:underline">Lihat Semua</a>
		</div>

		<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
			@forelse($jurusans as $jurusan)
				   <a href="{{ route('jurusan.detail', $jurusan->slug) }}" class="group block bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md">
						@if($jurusan->gambar && file_exists(public_path('storage/' . $jurusan->gambar)))
						<img src="{{ '/storage/' . $jurusan->gambar }}" alt="{{ $jurusan->nama_jurusan ?? $jurusan->judul ?? 'Jurusan' }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-200">
						@else
							<div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400">No Image</div>
						@endif
					<div class="p-2 text-sm">
						<div class="font-medium text-gray-900 truncate">{{ $jurusan->nama_jurusan ?? $jurusan->judul ?? 'Jurusan' }}</div>
						<div class="text-xs text-gray-500 mt-1">Biaya: Rp {{ number_format($jurusan->harga ?? 0, 0, ',', '.') }}</div>
					</div>
				</a>
			@empty
				<div class="col-span-6 text-gray-500">Belum ada jurusan.</div>
			@endforelse
		</div>
	</section>

	{{-- Galeri ringkas --}}
	<section class="mt-12">
		<div class="flex items-center justify-between mb-4">
			<h2 class="text-2xl font-bold">Galeri Terbaru</h2>
			<a href="{{ route('galeri') }}" class="text-blue-600 hover:underline">Lihat Semua</a>
		</div>

		<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
			@forelse($galeris as $g)
				<a href="{{ route('galeri.detail', $g->id) }}" class="block rounded-lg overflow-hidden shadow-sm">
					@if($g->cover_image_url)
						<img src="{{ $g->cover_image_url }}" alt="{{ $g->judul }}" class="w-full h-48 object-cover hover:scale-105 transition-transform duration-200">
					@else
						<div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400">No Image</div>
					@endif
					<div class="px-4 py-3 bg-white border-t border-gray-100 text-sm flex items-center justify-between text-gray-600">
						<span>{{ $g->judul }}</span>
						<span>{{ $g->gambar_count }} foto</span>
					</div>
				</a>
			@empty
				<div class="col-span-6 text-gray-500">Belum ada foto di galeri.</div>
			@endforelse
		</div>
	</section>

	{{-- Artikel Terbaru ringkas --}}
	<section class="mt-12">
		<div class="flex items-center justify-between mb-4">
			<h2 class="text-2xl font-bold">Artikel Terbaru</h2>
			<a href="{{ route('artikel') }}" class="text-blue-600 hover:underline">Lihat Semua</a>
		</div>

		<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
			@forelse($latestArtikels as $item)
				<article class="bg-white rounded-lg overflow-hidden shadow-sm">
					@if($item->thumbnail && file_exists(public_path('storage/' . $item->thumbnail)))
						<img src="{{ '/storage/' . $item->thumbnail }}" alt="{{ $item->judul }}" class="w-full h-44 object-cover">
					@else
						<div class="w-full h-44 bg-gray-100 flex items-center justify-center text-gray-400">No Image</div>
					@endif

					<div class="p-4">
						<h3 class="text-lg font-semibold text-gray-900">{{ $item->judul }}</h3>
						<p class="mt-2 text-sm text-gray-600">{{ \Illuminate\Support\Str::limit(strip_tags($item->konten), 120) }}</p>
						<div class="mt-3 flex items-center justify-between text-xs text-gray-500">
							<span>Oleh: {{ $item->user->name ?? '-' }}</span>
							<span>{{ $item->created_at->format('d M Y') }}</span>
						</div>
						<div class="mt-3">
							<a href="{{ route('artikel.detail', $item->slug) }}" class="text-blue-600 hover:underline">Baca Selangkapnya</a>
						</div>
					</div>
				</article>
			@empty
				<div class="col-span-3 text-gray-500">Belum ada artikel.</div>
			@endforelse
		</div>
	</section>

@endsection

