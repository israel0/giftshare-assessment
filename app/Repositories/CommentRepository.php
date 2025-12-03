<?php

namespace App\Http\Livewire\Listings;

use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Contracts\ListingRepositoryInterface;
use App\Services\ListingService;
use App\Models\Listing;
use App\Models\Category;

class ListingIndex extends Component
{
    use WithPagination;

    public $categories;
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
    }

    public function updatingFilters()
    {
        $this->resetPage();
    }

    public function render(ListingRepositoryInterface $listingRepository)
    {
        $listings = $listingRepository->filter($this->filters);

        return view('livewire.listings.listing-index', [
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
