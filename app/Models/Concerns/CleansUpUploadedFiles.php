<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

/**
 * Automatically deletes replaced or orphaned uploaded files.
 */
trait CleansUpUploadedFiles
{
    protected static function bootCleansUpUploadedFiles(): void
    {
        static::updating(function (Model $model): void {
            foreach ($model->getFileCleanupAttributes() as $attribute) {
                if (! $model->isDirty($attribute)) {
                    continue;
                }

                $originalPaths = $model->extractFilePaths($model->getOriginal($attribute));
                $currentPaths = $model->extractFilePaths($model->{$attribute});

                $removed = array_diff($originalPaths, $currentPaths);
                $model->deleteStoredFiles($removed);
            }
        });

        static::deleting(function (Model $model): void {
            foreach ($model->getFileCleanupAttributes() as $attribute) {
                $paths = $model->extractFilePaths($model->{$attribute});
                $model->deleteStoredFiles($paths);
            }
        });
    }

    /**
     * @return array<int, string>
     */
    protected function getFileCleanupAttributes(): array
    {
        $attributes = $this->fileCleanupAttributes ?? [];

        return is_array($attributes) ? $attributes : [$attributes];
    }

    protected function extractFilePaths(mixed $value): array
    {
        if (blank($value)) {
            return [];
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return array_values(array_filter($decoded));
            }

            return [$value];
        }

        if (is_array($value)) {
            return array_values(array_filter($value));
        }

        return [];
    }

    protected function deleteStoredFiles(array $paths): void
    {
        if (empty($paths)) {
            return;
        }

        $disk = property_exists($this, 'fileCleanupDisk')
            ? $this->fileCleanupDisk
            : config('filesystems.default');

        $wrappedPaths = Arr::wrap($paths);

        foreach ($wrappedPaths as $path) {
            if (! $path) {
                continue;
            }

            if (Storage::disk($disk)->exists($path)) {
                Storage::disk($disk)->delete($path);
            }
        }
    }
}
