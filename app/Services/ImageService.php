<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function storeListingPhoto(UploadedFile $file): array
    {
        $filename = time() . '_' . str()->random(10) . '.' . $file->getClientOriginalExtension();

        // Store original image
        $path = $file->storeAs('listings', $filename, 'public');

        // Optional: store a "thumbnail" as a copy of the same file
        $thumbnailPath = 'listings/thumbnails/' . $filename;
        Storage::disk('public')->copy($path, $thumbnailPath);

        return [
            'path' => $path,
            'thumbnail_path' => $thumbnailPath
        ];
    }

    public function deletePhoto(string $path, string $thumbnailPath): void
    {
        Storage::disk('public')->delete([$path, $thumbnailPath]);
    }
}
