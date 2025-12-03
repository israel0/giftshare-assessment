<?php

namespace App\Livewire\Listings;

use Livewire\Component;
use App\Models\Listing;
use App\Services\VoteService;
use App\DTOs\VoteDTO;
use Illuminate\Support\Facades\Auth;

class ListingCard extends Component
{

    public Listing $listing;
    public $userVote;

    public function mount($listing)
    {
        $this->listing = $listing;
        $this->loadUserVote();
    }

    public function loadUserVote()
    {
        if (Auth::check()) {
            $this->userVote = $this->listing->votes()
                ->where('user_id', Auth::id())
                ->value('type');
        }
    }

    public function vote($type, VoteService $voteService)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $dto = new VoteDTO(
            userId: Auth::id(),
            listingId: $this->listing->id,
            type: $type
        );

        $voteService->toggleVote($dto);
        $this->listing->refresh();
        $this->loadUserVote();
        $this->dispatch('voteUpdated');
    }

    public function render()
    {
        return view('livewire.listings.listing-card');
    }
}
