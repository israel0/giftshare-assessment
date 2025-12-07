<div>
    <!-- Comment Form -->
    @auth
        <div class="mb-4">
            <form wire:submit.prevent="addComment">
                <div class="d-flex gap-3">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=667eea&color=fff"
                         alt="{{ auth()->user()->name }}"
                         class="rounded-circle"
                         width="48"
                         height="48">
                    <div class="flex-grow-1">
                        <textarea wire:model="newComment"
                                  class="form-control"
                                  rows="3"
                                  placeholder="Share your thoughts on this item..."
                                  required></textarea>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <small class="text-muted">Be kind and respectful</small>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-send me-1"></i>Post Comment
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @else
        <div class="alert alert-info mb-4">
            <div class="d-flex align-items-center">
                <i class="bi bi-info-circle fs-4 me-3"></i>
                <div>
                    <strong>Want to join the conversation?</strong>
                    <p class="mb-0">Please <a href="{{ route('login') }}" class="alert-link">login</a> to comment.</p>
                </div>
            </div>
        </div>
    @endauth

    <!-- Comments List -->
    <div class="comments-list">
        @forelse($comments as $comment)
            <div class="comment-item mb-4" id="comment-{{ $comment->id }}">
                <div class="d-flex gap-3">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&background=667eea&color=fff"
                         alt="{{ $comment->user->name }}"
                         class="rounded-circle"
                         width="40"
                         height="40">
                    <div class="flex-grow-1">
                        <div class="card border-0 bg-light">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <strong class="d-block">{{ $comment->user->name }}</strong>
                                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                    </div>
                                    @if(auth()->id() === $comment->user_id || auth()->id() === $listing->user_id)
                                        <button wire:click="deleteComment({{ $comment->id }})"
                                                wire:confirm="Delete this comment?"
                                                class="btn btn-sm btn-link text-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    @endif
                                </div>
                                <p class="mb-0" style="white-space: pre-line;">{{ $comment->content }}</p>

                                @auth
                                    <div class="mt-2">
                                        <button wire:click="replyToComment({{ $comment->id }})"
                                                class="btn btn-sm btn-link text-primary p-0">
                                            <i class="bi bi-reply me-1"></i>Reply
                                        </button>
                                    </div>
                                @endauth
                            </div>
                        </div>

                        <!-- Reply Form -->
                        @if($replyTo === $comment->id)
                            <div class="mt-3 ms-4">
                                <form wire:submit.prevent="addReply({{ $comment->id }})">
                                    <div class="d-flex gap-2">
                                        <textarea wire:model="replyContent"
                                                  class="form-control form-control-sm"
                                                  rows="2"
                                                  placeholder="Write a reply..."
                                                  required
                                                  autofocus></textarea>
                                        <div class="d-flex flex-column gap-1">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="bi bi-send"></i>
                                            </button>
                                            <button type="button"
                                                    wire:click="$set('replyTo', null)"
                                                    class="btn btn-outline-secondary btn-sm">
                                                <i class="bi bi-x"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif

                        <!-- Replies -->
                        @if($comment->replies->count() > 0)
                            <div class="replies ms-4 mt-3">
                                @foreach($comment->replies as $reply)
                                    <div class="reply-item mb-3">
                                        <div class="d-flex gap-2">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($reply->user->name) }}&background=6c757d&color=fff"
                                                 alt="{{ $reply->user->name }}"
                                                 class="rounded-circle"
                                                 width="32"
                                                 height="32">
                                            <div class="flex-grow-1">
                                                <div class="card border-0 bg-white border-start border-3 border-secondary">
                                                    <div class="card-body py-2">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <div>
                                                                <strong class="d-block small">{{ $reply->user->name }}</strong>
                                                                <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                                                            </div>
                                                            @if(auth()->id() === $reply->user_id || auth()->id() === $listing->user_id)
                                                                <button wire:click="deleteComment({{ $reply->id }})"
                                                                        wire:confirm="Delete this reply?"
                                                                        class="btn btn-sm btn-link text-danger p-0">
                                                                    <i class="bi bi-trash small"></i>
                                                                </button>
                                                            @endif
                                                        </div>
                                                        <p class="mb-0 small" style="white-space: pre-line;">{{ $reply->content }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <i class="bi bi-chat-text display-1 text-muted mb-3"></i>
                <h5 class="text-muted">No comments yet</h5>
                <p class="text-muted">Be the first to share your thoughts!</p>
            </div>
        @endforelse
    </div>
</div>
