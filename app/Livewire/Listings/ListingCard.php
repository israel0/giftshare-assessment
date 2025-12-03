<?php

namespace App\Http\Livewire\Listings;

use Livewire\Component;
use App\Models\Listing;

class ListingCard extends Component
{
    public Listing $listing;

    public function render()
    {
        return view('livewire.listings._listing-card');
    }

    public function showListing()
    {
        return redirect()->route('listings.show', $this->listing->slug);
    }
}
