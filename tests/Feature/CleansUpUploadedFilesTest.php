<?php

namespace Tests\Feature;

use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\Jurusan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CleansUpUploadedFilesTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_removes_old_file_when_galeri_image_is_replaced(): void
    {
        Storage::fake('public');
        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk = Storage::disk('public');

        $disk->put('thumbnails-artikel/old-galeri.jpg', 'old');
        $disk->put('thumbnails-artikel/new-galeri.jpg', 'new');

        $galeri = Galeri::create([
            'judul' => 'Galeri A',
            'gambar' => 'thumbnails-artikel/old-galeri.jpg',
            'deskripsi_singkat' => 'Singkat',
        ]);

        $galeri->update(['gambar' => 'thumbnails-artikel/new-galeri.jpg']);

        $disk->assertMissing('thumbnails-artikel/old-galeri.jpg');
    }

    public function test_it_only_removes_deleted_files_for_galeri_when_using_multiple_images(): void
    {
        Storage::fake('public');
        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk = Storage::disk('public');

        $disk->put('galeri/keep.jpg', 'keep');
        $disk->put('galeri/remove.jpg', 'remove');
        $disk->put('galeri/new.jpg', 'new');

        $galeri = Galeri::create([
            'judul' => 'Galeri Multi',
            'gambar' => ['galeri/keep.jpg', 'galeri/remove.jpg'],
            'deskripsi_singkat' => 'Singkat',
        ]);

        $galeri->update([
            'gambar' => ['galeri/keep.jpg', 'galeri/new.jpg'],
        ]);

        $disk->assertMissing('galeri/remove.jpg');
        $disk->assertExists('galeri/keep.jpg');
    }

    public function test_it_removes_old_thumbnail_when_artikel_image_is_replaced(): void
    {
        Storage::fake('public');
        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk = Storage::disk('public');

        $user = User::factory()->create();

        $disk->put('thumbnails-artikel/old-thumb.jpg', 'old');
        $disk->put('thumbnails-artikel/new-thumb.jpg', 'new');

        $artikel = Artikel::create([
            'judul' => 'Artikel A',
            'slug' => 'artikel-a',
            'konten' => 'Konten',
            'thumbnail' => 'thumbnails-artikel/old-thumb.jpg',
            'status' => 'draft',
            'user_id' => $user->id,
        ]);

        $artikel->update(['thumbnail' => 'thumbnails-artikel/new-thumb.jpg']);

        $disk->assertMissing('thumbnails-artikel/old-thumb.jpg');
    }

    public function test_it_removes_old_file_when_jurusan_image_is_replaced(): void
    {
        Storage::fake('public');
        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk = Storage::disk('public');

        $disk->put('thumbnails-artikel/old-jurusan.jpg', 'old');
        $disk->put('thumbnails-artikel/new-jurusan.jpg', 'new');

        $jurusan = Jurusan::create([
            'nama_jurusan' => 'Jurusan A',
            'slug' => 'jurusan-a',
            'deskripsi' => 'Deskripsi',
            'gambar' => 'thumbnails-artikel/old-jurusan.jpg',
            'harga' => 10000,
        ]);

        $jurusan->update(['gambar' => 'thumbnails-artikel/new-jurusan.jpg']);

        $disk->assertMissing('thumbnails-artikel/old-jurusan.jpg');
    }
}
