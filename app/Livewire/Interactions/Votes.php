<?php

namespace App\Http\Livewire\Interactions;

use Livewire\Component;
use App\Services\VoteService;
use App\DTOs\VoteDTO;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;

class Votes extends Component
{

    public Listing $listing;
    public $userVote;
    public $upvotesCount;
    public $downvotesCount;

    protected $listeners = ['voteUpdated'];

    public function mount($listing)
    {
        $this->listing = $listing;
        $this->loadVoteData();
    }

    public function loadVoteData()
    {
        $this->userVote = $this->listing->votes()
            ->where('user_id', Auth::id())
            ->value('type');

        $this->upvotesCount = $this->listing->upvotes_count;
        $this->downvotesCount = $this->listing->downvotes_count;
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
        $this->loadVoteData();
        $this->emit('voteUpdated');
    }

    public function voteUpdated()
    {
        $this->dispatchBrowserEvent('vote-updated');
    }

    public function render()
    {
        return view('livewire.interactions.votes');
    }
}
