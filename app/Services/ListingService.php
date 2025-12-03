<?php

namespace App\Services;

use App\DTOs\ListingDTO;
use App\Models\Listing;
use App\Models\ListingPhoto;
use App\Repositories\Contracts\ListingRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ListingService
{
    public function __construct(
        protected ListingRepositoryInterface $listingRepository,
        protected ImageService $imageService
    ) {}

    public function createListing(ListingDTO $dto, int $userId): Listing
    {
        $data = $dto->toArray();
        $data['user_id'] = $userId;
        $data['slug'] = $this->generateSlug($dto->title);

        $listing = $this->listingRepository->create($data);

        if ($dto->photos) {
            $this->processPhotos($listing, $dto->photos);
        }

        return $listing->load(['photos', 'category']);
    }

    public function updateListing(Listing $listing, ListingDTO $dto): Listing
    {
        $data = $dto->toArray();

        if ($listing->title !== $dto->title) {
            $data['slug'] = $this->generateSlug($dto->title);
        }

        $this->listingRepository->updateListing($listing, $data);

        if ($dto->photos) {
            $this->processPhotos($listing, $dto->photos);
        }

        return $listing->fresh(['photos', 'category']);
    }

    public function deleteListing(Listing $listing): bool
    {
        foreach ($listing->photos as $photo) {
            Storage::delete([$photo->path, $photo->thumbnail_path]);
        }

        return $this->listingRepository->deleteListing($listing);
    }

    public function markAsGifted(Listing $listing): Listing
    {
        $listing->markAsGifted();
        return $listing->fresh();
    }

    protected function generateSlug(string $title): string
    {
        $slug = str($title)->slug();
        $count = Listing::where('slug', 'like', $slug . '%')->count();

        return $count > 0 ? $slug . '-' . ($count + 1) : $slug;
    }

    protected function processPhotos(Listing $listing, array $photos): void
    {
        foreach ($photos as $order => $photo) {
            if ($photo instanceof UploadedFile) {
                $paths = $this->imageService->storeListingPhoto($photo);

                ListingPhoto::create([
                    'listing_id' => $listing->id,
                    'path' => $paths['path'],
                    'thumbnail_path' => $paths['thumbnail_path'],
                    'order' => $order
                ]);
            }
        }
    }
}
