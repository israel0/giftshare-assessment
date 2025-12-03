<?php

namespace App\Http\Livewire\Listings;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\DTO\ListingDTO;
use App\Models\Listing;
use App\Models\Category;
use App\Services\ListingService;

class ListingForm extends Component
{
    use WithFileUploads;

    public Listing $listing;
    public $categories;
    public $photos = [];
    public $title;
    public $description;
    public $category_id;
    public $city;
    public $weight;
    public $dimensions;
    public $existingPhotos = [];

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'description' => 'required|min:10|max:2000',
        'category_id' => 'required|exists:categories,id',
        'city' => 'required|max:100',
        'weight' => 'nullable|numeric|min:0',
        'dimensions' => 'nullable|string|max:100',
        'photos.*' => 'nullable|image|max:5120', // 5MB
    ];

    public function mount(Listing $listing = null)
    {
        $this->categories = Category::all();

        if ($listing->exists) {
            $this->listing = $listing;
            $this->title = $listing->title;
            $this->description = $listing->description;
            $this->category_id = $listing->category_id;
            $this->city = $listing->city;
            $this->weight = $listing->weight;
            $this->dimensions = $listing->dimensions;
            $this->existingPhotos = $listing->photos;
        } else {
            $this->listing = new Listing();
        }
    }

    public function render()
    {
        return view('livewire.listings.form');
    }

    public function save(ListingService $listingService)
    {
        $this->validate();

        $dto = new ListingDTO(
            title: $this->title,
            description: $this->description,
            categoryId: $this->category_id,
            city: $this->city,
            weight: $this->weight,
            dimensions: $this->dimensions,
            photos: $this->photos
        );

        if ($this->listing->exists) {
            $listing = $listingService->updateListing($this->listing, $dto);
            $message = 'Listing updated successfully!';
        } else {
            $listing = $listingService->createListing($dto, auth()->id());
            $message = 'Listing created successfully!';
        }

        $this->emit('listingCreated');
        session()->flash('message', $message);

        return redirect()->route('listings.show', $listing->slug);
    }

    public function removePhoto($index)
    {
        if (isset($this->photos[$index])) {
            unset($this->photos[$index]);
            $this->photos = array_values($this->photos);
        }
    }

    public function removeExistingPhoto($photoId)
    {
        $photo = $this->existingPhotos->firstWhere('id', $photoId);
        if ($photo) {
            $photo->delete();
            $this->existingPhotos = $this->existingPhotos->except($photoId);
        }
    }
}
