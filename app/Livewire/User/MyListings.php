<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Contracts\ListingRepositoryInterface;
use App\Services\ListingService;
use Illuminate\Support\Facades\Auth;

class MyListings extends Component
{
    use WithPagination;


    public $listings;

    public function mount(ListingRepositoryInterface $listingRepository)
    {
        $this->listings = $listingRepository->getUserListings(Auth::id());
    }

    public function markAsGifted(ListingService $listingService, $listingId)
    {
        $listing = \App\Models\Listing::findOrFail($listingId);

        if ($listing->user_id !== Auth::id()) {
            abort(403);
        }

        $listingService->markAsGifted($listing);
        $this->listings = $listingService->getUserListings(Auth::id());
        session()->flash('message', 'Listing marked as gifted!');
    }

    public function deleteListing(ListingService $listingService, $listingId)
    {
        $listing = \App\Models\Listing::findOrFail($listingId);

        if ($listing->user_id !== Auth::id()) {
            abort(403);
        }

        $listingService->deleteListing($listing);
        $this->listings = $listingService->getUserListings(Auth::id());
        session()->flash('message', 'Listing deleted successfully!');
    }

    public function render()
    {
        return view('livewire.user.my-listings');
    }
}
