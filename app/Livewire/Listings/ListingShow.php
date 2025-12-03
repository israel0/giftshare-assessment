<?php

namespace App\Livewire\Listings;

use Livewire\Component;
use App\Services\ListingService;
use App\Models\Listing;

class ListingShow extends Component
{
    public Listing $listing;
    public $slug;

    public function mount($slug, ListingService $listingService)
    {
        $this->listing = Listing::where('slug', $slug)
            ->with(['user', 'category', 'photos', 'comments.user'])
            ->firstOrFail();
    }

    public function markAsGifted(ListingService $listingService)
    {
        if ($this->listing->user_id !== auth()->id()) {
            abort(403);
        }

        $this->listing = $listingService->markAsGifted($this->listing);
        session()->flash('message', 'Listing marked as gifted!');
    }

    public function deleteListing(ListingService $listingService)
    {
        if ($this->listing->user_id !== auth()->id()) {
            abort(403);
        }

        $listingService->deleteListing($this->listing);
        session()->flash('message', 'Listing deleted successfully!');

        return redirect()->route('listings.listing-index');
    }

    public function render()
    {
        return view('livewire.listings.listing-show');
    }
}
