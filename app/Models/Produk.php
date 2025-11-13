<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Produk extends Model
{
    protected $fillable = [
        'nama_produk',
        'slug',
        'deskripsi',
        'gambar',
        'harga',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->slug) {
                $model->slug = Str::slug($model->nama_produk);
            }
        });
        static::updating(function ($model) {
            if ($model->isDirty('nama_produk') && !$model->isDirty('slug')) {
                $model->slug = Str::slug($model->nama_produk);
            }
        });
    }
}
