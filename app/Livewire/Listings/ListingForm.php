<?php

namespace App\Livewire\Listings;

use Livewire\Component;
use App\Services\ListingService;
use App\DTO\ListingDTO;
use App\Models\Listing;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class ListingForm extends Component
{
    use WithFileUploads;


    public Listing $listing;
    public $title;
    public $categories;
    public $description;
    public $category_id;
    public $city;
    public $weight;
    public $dimensions;
    public $photos = [];
    public $isEdit = false;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string|min:10',
        'category_id' => 'required|exists:categories,id',
        'city' => 'required|string|max:100',
        'weight' => 'nullable|numeric|min:0',
        'dimensions' => 'nullable|string|max:100',
        'photos.*' => 'nullable|image|max:2048',
    ];

    public function mount($listingId = null)
    {
        $this->categories = Category::all();

        if ($listingId) {
            $this->isEdit = true;
            $this->listing = Listing::findOrFail($listingId);

            if ($this->listing->user_id !== Auth::id()) {
                abort(403);
            }

            $this->title = $this->listing->title;
            $this->description = $this->listing->description;
            $this->category_id = $this->listing->category_id;
            $this->city = $this->listing->city;
            $this->weight = $this->listing->weight;
            $this->dimensions = $this->listing->dimensions;
        }
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

        if ($this->isEdit) {
            $listing = $listingService->updateListing($this->listing, $dto);
            session()->flash('message', 'Listing updated successfully!');
        } else {
            $listing = $listingService->createListing($dto, Auth::id());
            session()->flash('message', 'Listing created successfully!');
        }

        return redirect()->route('listings.listing-show', $listing->slug);
    }

    public function removePhoto($index)
    {
        unset($this->photos[$index]);
        $this->photos = array_values($this->photos);
    }

    public function render()
    {
            return view('livewire.listings.listing-form', [
                'categories' => $this->categories
            ]);
    }
}
