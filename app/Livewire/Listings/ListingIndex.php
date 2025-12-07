<?php

namespace App\Livewire\Listings;

use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Contracts\ListingRepositoryInterface;
use App\Models\Listing;
use App\Models\Category;

class ListingIndex extends Component
{
    use WithPagination;

    public $categories;
    public $totalListings = 0;
    public $availableCount = 0;
    public $giftedCount = 0;
    public $filters = [
        'search' => '',
        'category_id' => '',
        'city' => '',
        'status' => 'available',
        'sort' => 'newest',
        'per_page' => 12
    ];

    protected $queryString = [
        'filters.search' => ['except' => ''],
        'filters.category_id' => ['except' => ''],
        'filters.city' => ['except' => ''],
        'filters.status' => ['except' => 'available'],
        'filters.sort' => ['except' => 'newest'],
        'filters.per_page' => ['except' => 12]
    ];

    public function mount(ListingRepositoryInterface $listingRepository)
    {
        $this->categories = Category::all();
        $this->loadStatistics();
    }

    public function loadStatistics()
    {
        $this->totalListings = Listing::count();
        $this->availableCount = Listing::where('status', 'available')->count();
        $this->giftedCount = Listing::where('status', 'gifted')->count();
    }

    public function updatingFilters()
    {
        $this->resetPage();
    }

    public function render(ListingRepositoryInterface $listingRepository)
    {
        $listings = $listingRepository->filter($this->filters);

        return view('livewire.pages.listings.listing-index', [
            'listings' => $listings
        ]);
    }

    public function resetFilters()
    {
        $this->filters = [
            'search' => '',
            'category_id' => '',
            'city' => '',
            'status' => 'available',
            'sort' => 'newest',
            'per_page' => 12
        ];
    }
}
