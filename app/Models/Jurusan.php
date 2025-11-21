<?php

namespace App\Models;

use App\Models\Concerns\CleansUpUploadedFiles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Jurusan extends Model
{
    use CleansUpUploadedFiles;

    protected $fillable = [
        'nama_jurusan',
        'slug',
        'deskripsi',
        'gambar',
        'harga',
    ];

    protected array $fileCleanupAttributes = ['gambar'];
    protected string $fileCleanupDisk = 'public';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->slug) {
                $model->slug = Str::slug($model->nama_jurusan);
            }
        });
        static::updating(function ($model) {
            if ($model->isDirty('nama_jurusan') && !$model->isDirty('slug')) {
                $model->slug = Str::slug($model->nama_jurusan);
            }
        });
    }
}
