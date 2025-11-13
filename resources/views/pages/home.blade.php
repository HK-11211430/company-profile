@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
				<img src="{{ $hero ?? 'https://scontent.fcgk32-1.fna.fbcdn.net/v/t39.30808-6/471269024_1348898676413282_628383651423106230_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=vK7scIdfVs4Q7kNvwHuFWPA&_nc_oc=Adk9Rmhm3a5kWL0_UrqNEgU_M4NT1RcQEo7bOoYJRbkEn9CRpS_tJlQ0PwR3xED6qmg&_nc_zt=23&_nc_ht=scontent.fcgk32-1.fna&_nc_gid=1zTpxq3VG_4ywu0pI1c4vA&oh=00_AfhC35NUZWCW1RM2dZM23lKxYb-j3vBeuMoAuKcWZVT0ng&oe=69165D57' }}" alt="hero" class="w-full h-full object-cover">
			</div>
		</div>
	</section>
	<section class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-6">
		<div class="bg-white rounded-lg p-6 shadow-sm">
			<h3 class="text-xl font-semibold text-gray-900">Jurusan Berkualitas</h3>
			<p class="mt-2 text-gray-600">Kami Memiliki 3 Jurusan dengan standar mutu tinggi dan dukungan purna jual yang dapat diandalkan.</p>
		</div>
		<div class="bg-white rounded-lg p-6 shadow-sm">
			<h3 class="text-xl font-semibold text-gray-900">Layanan Profesional</h3>
			<p class="mt-2 text-gray-600">Tim ahli kami siap membantu konsultasi teknis dan implementasi solusi untuk kebutuhan Anda.</p>
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
			$img = $g->gambar && file_exists(public_path('storage/' . $g->gambar)) ? '/storage/' . $g->gambar : null;
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


	{{-- Produk Terbaru --}}
	@php
		$produks = \App\Models\Produk::latest()->take(6)->get();
	@endphp
	<section class="mt-12">
		<div class="flex items-center justify-between mb-4">
			<h2 class="text-2xl font-bold">Produk Terbaru</h2>
			<a href="{{ route('produk') }}" class="text-blue-600 hover:underline">Lihat Semua</a>
		</div>

		<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
			@forelse($produks as $produk)
				<a href="#" class="group block bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md">
						@if($produk->gambar && file_exists(public_path('storage/' . $produk->gambar)))
						<img src="{{ '/storage/' . $produk->gambar }}" alt="{{ $produk->nama ?? $produk->judul ?? 'Produk' }}" class="w-full h-36 object-cover group-hover:scale-105 transition-transform duration-200">
					@else
						<div class="w-full h-36 bg-gray-100 flex items-center justify-center text-gray-400">No Image</div>
					@endif
					<div class="p-2 text-sm">
						<div class="font-medium text-gray-900 truncate">{{ $produk->nama ?? $produk->judul ?? 'Produk' }}</div>
						<div class="text-xs text-gray-500 mt-1">Rp {{ number_format($produk->harga ?? 0, 0, ',', '.') }}</div>
					</div>
				</a>
			@empty
				<div class="col-span-6 text-gray-500">Belum ada produk.</div>
			@endforelse
		</div>
	</section>

	{{-- Galeri ringkas --}}
	<section class="mt-12">
		<div class="flex items-center justify-between mb-4">
			<h2 class="text-2xl font-bold">Galeri Terbaru</h2>
			<a href="{{ route('galeri') }}" class="text-blue-600 hover:underline">Lihat Semua</a>
		</div>

		<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-3">
			@forelse($galeris as $g)
				<a href="{{ route('galeri.detail', $g->id) }}" class="block rounded-lg overflow-hidden shadow-sm">
					@if($g->gambar && file_exists(public_path('storage/' . $g->gambar)))
						<img src="{{ '/storage/' . $g->gambar }}" alt="{{ $g->judul }}" class="w-full h-28 object-cover hover:scale-105 transition-transform duration-200">
					@else
						<div class="w-full h-28 bg-gray-100 flex items-center justify-center text-gray-400">No Image</div>
					@endif
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

