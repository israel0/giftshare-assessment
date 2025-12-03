<?php

namespace App\Livewire\Interactions;

use Livewire\Component;
use App\DTOs\CommentDTO;
use App\Models\Listing;
use App\Services\CommentService;

class CommentForm extends Component
{

    public Listing $listing;
    public $content = '';
    public $parentId = null;

    protected $rules = [
        'content' => 'required|min:3|max:1000',
    ];

    public function mount(Listing $listing, $parentId = null)
    {
        $this->listing = $listing;
        $this->parentId = $parentId;
    }

    public function render()
    {
        return view('livewire.interactions.comment-form');
    }

    public function save(CommentService $commentService)
    {
        $this->validate();

        $dto = new CommentDTO(
            userId: auth()->id(),
            listingId: $this->listing->id,
            parentId: $this->parentId,
            content: $this->content
        );

        $commentService->createComment($dto);

        $this->content = '';
        $this->dispatch('commentCreated');

        if ($this->parentId) {
            $this->dispatch('replyCreated');
        }

        session()->flash('message', 'Comment posted successfully!');
    }
}
