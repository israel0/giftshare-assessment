<?php

namespace App\Http\Livewire\Listings;

use Livewire\Component;
use App\Models\Listing;
use App\Services\ListingService;
use Illuminate\Support\Facades\Auth;

class ListingShow extends Component
{
    public Listing $listing;

    protected $listeners = [
        'commentCreated' => '$refresh',
        'commentDeleted' => '$refresh',
        'voteUpdated' => '$refresh',
        'listingMarkedAsGifted' => '$refresh',
    ];

    public function mount($slug)
    {
        $this->listing = Listing::with([
            'user',
            'category',
            'photos',
            'comments.user',
            'votes'
        ])->where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.listings.show');
    }

    public function markAsGifted(ListingService $listingService)
    {
        $this->authorize('update', $this->listing);

        $listingService->markAsGifted($this->listing);
        $this->emit('listingMarkedAsGifted');

        session()->flash('message', 'Listing marked as gifted!');
    }

    public function deleteListing(ListingService $listingService)
    {
        $this->authorize('delete', $this->listing);

        $listingService->deleteListing($this->listing);

        session()->flash('message', 'Listing deleted successfully!');
        return redirect()->route('listings.index');
    }
}
