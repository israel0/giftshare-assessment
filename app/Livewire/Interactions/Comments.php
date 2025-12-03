<?php

namespace App\Livewire\Interactions;

use Livewire\Component;
use App\Services\CommentService;
use App\DTOs\CommentDTO;
use App\Models\Listing;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class Comments extends Component
{
    public Listing $listing;
    public $comments = [];
    public $newComment = '';
    public $replyTo = null;
    public $replyContent = '';

    protected $listeners = ['commentAdded', 'commentDeleted'];

    public function mount($listing)
    {
        $this->listing = $listing;
        $this->loadComments();
    }

    public function loadComments()
    {
        $this->comments = $this->listing->comments()
            ->whereNull('parent_id')
            ->with(['user', 'replies.user'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function addComment(CommentService $commentService)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->validate([
            'newComment' => 'required|string|min:3|max:1000'
        ]);

        $dto = new CommentDTO(
            userId: Auth::id(),
            listingId: $this->listing->id,
            content: $this->newComment,
            parentId: null
        );

        $commentService->createComment($dto);

        $this->newComment = '';
        $this->loadComments();
        $this->listing->refresh();
        $this->dispatch('commentAdded');
    }

    public function replyToComment($commentId)
    {
        $this->replyTo = $commentId;
        $this->dispatchBrowserEvent('focus-reply-input');
    }

    public function addReply(CommentService $commentService, $parentId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->validate([
            'replyContent' => 'required|string|min:3|max:1000'
        ]);

        $dto = new CommentDTO(
            userId: Auth::id(),
            listingId: $this->listing->id,
            content: $this->replyContent,
            parentId: $parentId
        );

        $commentService->createComment($dto);

        $this->replyContent = '';
        $this->replyTo = null;
        $this->loadComments();
        $this->listing->refresh();
        $this->dispatch('commentAdded');
    }

    public function deleteComment(CommentService $commentService, $commentId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $comment = Comment::findOrFail($commentId);

        if ($comment->user_id !== Auth::id() && $this->listing->user_id !== Auth::id()) {
            abort(403);
        }

        $commentService->deleteComment($comment);
        $this->loadComments();
        $this->listing->refresh();
        $this->dispatch('commentDeleted');
    }

    public function commentAdded()
    {
        $this->dispatchBrowserEvent('comment-added');
    }

    public function render()
    {
        return view('livewire.interactions.comments');
    }
}
