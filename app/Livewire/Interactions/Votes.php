<?php

namespace App\Http\Livewire\Interactions;

use Livewire\Component;
use App\DTO\VoteDTO;
use App\Models\Listing;
use App\Services\VoteService;

class Votes extends Component
{
    public Listing $listing;
    public $votesCount;
    public $userVote;

    protected $listeners = ['voteUpdated' => 'refreshVotes'];

    public function mount(Listing $listing)
    {
        $this->listing = $listing;
        $this->refreshVotes();
    }

    public function render()
    {
        return view('livewire.interactions.votes');
    }

    public function refreshVotes()
    {
        $this->votesCount = $this->listing->votes_count;
        $this->userVote = app(VoteService::class)->getUserVote(
            auth()->id(),
            $this->listing->id
        );
    }

    public function vote($type, VoteService $voteService)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $dto = new VoteDTO(
            userId: auth()->id(),
            listingId: $this->listing->id,
            type: $type
        );

        $voteService->toggleVote($dto);
        $this->emit('voteUpdated');

        $this->refreshVotes();
    }
}
