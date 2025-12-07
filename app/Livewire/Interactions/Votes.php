<?php

namespace App\Livewire\Interactions;

use Livewire\Component;
use App\Services\VoteService;
use App\DTO\VoteDTO;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;

class Votes extends Component
{
    public Listing $listing;
    public $userVote = null;
    public $upvotesCount = 0;
    public $downvotesCount = 0;

    protected $listeners = ['voteUpdated'];

    public function mount($listing)
    {
        $this->listing = $listing;
        $this->loadVoteData();
    }

    public function loadVoteData()
    {
        if (Auth::check()) {
            $this->userVote = $this->listing->votes()
                ->where('user_id', Auth::id())
                ->value('type');
        }

        $this->upvotesCount = $this->listing->upvotes_count ?? 0;
        $this->downvotesCount = $this->listing->downvotes_count ?? 0;
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

        // Refresh the listing data
        $this->listing->refresh();
        $this->loadVoteData();

        $this->dispatch('voteUpdated');
    }

    public function voteUpdated()
    {
        $this->dispatch('vote-updated');
    }

    public function render()
    {
        return view('livewire.pages.interactions.votes');
    }
}
