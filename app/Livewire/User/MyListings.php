<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Contracts\ListingRepositoryInterface;

class MyListings extends Component
{
    use WithPagination;

    public $status = '';

    public function render(ListingRepositoryInterface $listingRepository)
    {
        $listings = $listingRepository->getUserListings(
            auth()->id(),
            $this->status
        );

        return view('livewire.user.my-listings', [
            'listings' => $listings,
        ]);
    }
}
