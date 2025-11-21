<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('produks')) {
            return;
        }

        Schema::create('jurusans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jurusan');
            $table->text('deskripsi');
            $table->string('gambar')->nullable();
            $table->decimal('harga', 15, 2)->nullable();
            $table->string('slug')->nullable()->unique();
            $table->timestamps();
        });

        // Copy data from produks to jurusans
        $rows = DB::table('produks')->get();
        foreach ($rows as $row) {
            DB::table('jurusans')->insert([
                'id' => $row->id,
                'nama_jurusan' => $row->nama_produk,
                'deskripsi' => $row->deskripsi,
                'gambar' => $row->gambar,
                'harga' => property_exists($row, 'harga') ? $row->harga : null,
                'slug' => property_exists($row, 'slug') ? $row->slug : null,
                'created_at' => $row->created_at,
                'updated_at' => $row->updated_at,
            ]);
        }

        Schema::dropIfExists('produks');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('jurusans')) {
            return;
        }

        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->text('deskripsi');
            $table->string('gambar')->nullable();
            $table->decimal('harga', 15, 2)->nullable();
            $table->string('slug')->nullable()->unique();
            $table->timestamps();
        });

        $rows = DB::table('jurusans')->get();
        foreach ($rows as $row) {
            DB::table('produks')->insert([
                'id' => $row->id,
                'nama_produk' => $row->nama_jurusan,
                'deskripsi' => $row->deskripsi,
                'gambar' => $row->gambar,
                'harga' => property_exists($row, 'harga') ? $row->harga : null,
                'slug' => property_exists($row, 'slug') ? $row->slug : null,
                'created_at' => $row->created_at,
                'updated_at' => $row->updated_at,
            ]);
        }

        Schema::dropIfExists('jurusans');
    }
};
