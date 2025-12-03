<?php

namespace App\Http\Livewire\Interactions;

use Livewire\Component;
use App\Models\Listing;
use App\Models\Comment;

class Comments extends Component
{
    public Listing $listing;
    public $comments;
    public $replyTo = null;
    public $replyContent = '';

    protected $listeners = [
        'commentCreated' => '$refresh',
        'commentDeleted' => '$refresh',
    ];

    public function mount(Listing $listing)
    {
        $this->listing = $listing;
        $this->loadComments();
    }

    public function render()
    {
        return view('livewire.interactions.comments');
    }

    public function loadComments()
    {
        $this->comments = Comment::with(['user', 'replies.user'])
            ->where('listing_id', $this->listing->id)
            ->whereNull('parent_id')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function replyTo($commentId)
    {
        $this->replyTo = $commentId;
        $this->dispatchBrowserEvent('focus-reply-input');
    }

    public function cancelReply()
    {
        $this->replyTo = null;
        $this->replyContent = '';
    }

    public function deleteComment(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();
        $this->emit('commentDeleted');

        session()->flash('message', 'Comment deleted successfully!');
    }
}
