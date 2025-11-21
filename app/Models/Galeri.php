<?php

namespace App\Models;

use App\Models\Concerns\CleansUpUploadedFiles;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Galeri extends Model
{
    use HasFactory;
    use CleansUpUploadedFiles;

    protected $table = 'galeris';

    protected $fillable = [
        'judul',
        'gambar',
        'deskripsi_singkat',
    ];

    protected array $fileCleanupAttributes = ['gambar'];
    protected string $fileCleanupDisk = 'public';

    protected function gambar(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (is_array($value)) {
                    return array_values(array_filter($value));
                }

                if (blank($value)) {
                    return [];
                }

                $decoded = json_decode($value, true);

                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    return array_values(array_filter($decoded));
                }

                return [$value];
            },
            set: function ($value) {
                $paths = array_values(array_filter(Arr::wrap($value)));

                return empty($paths)
                    ? null
                    : json_encode($paths);
            }
        );
    }

    protected function coverImage(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->gambar[0] ?? null,
        );
    }

    public function getGambarCountAttribute(): int
    {
        return count($this->gambar ?? []);
    }

    public function getCoverImageUrlAttribute(): ?string
    {
        return $this->cover_image ? '/storage/' . ltrim($this->cover_image, '/') : null;
    }

    public function getGambarUrlsAttribute(): array
    {
        return collect($this->gambar ?? [])
            ->map(fn($path) => '/storage/' . ltrim($path, '/'))
            ->all();
    }
}
