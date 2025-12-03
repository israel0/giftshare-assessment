<?php

namespace App\Http\Livewire\Listings;

use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Contracts\ListingRepositoryInterface;
use App\Models\Category;

class ListingIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $city = '';
    public $status = '';
    public $sortBy = 'newest';
    public $perPage = 12;

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
        'city' => ['except' => ''],
        'status' => ['except' => ''],
        'sortBy' => ['except' => 'newest'],
    ];

    protected $listeners = [
        'listingCreated' => '$refresh',
        'listingUpdated' => '$refresh',
        'listingDeleted' => '$refresh',
        'listingMarkedAsGifted' => '$refresh',
    ];

    public function render(ListingRepositoryInterface $listingRepository)
    {
        $listings = $listingRepository->getFilteredListings(
            $this->search,
            $this->category,
            $this->city,
            $this->status,
            $this->sortBy,
            $this->perPage
        );

        $categories = Category::all();
        $cities = $listingRepository->getAvailableCities();

        return view('livewire.listings.index', [
            'listings' => $listings,
            'categories' => $categories,
            'cities' => $cities,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingCity()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'category', 'city', 'status', 'sortBy']);
        $this->resetPage();
    }
}
