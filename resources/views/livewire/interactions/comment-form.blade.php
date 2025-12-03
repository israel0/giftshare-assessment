<div>
    @if($isReplying)
        <div class="alert alert-info alert-dismissible fade show mb-3" role="alert">
            <i class="bi bi-reply-fill me-2"></i>
            <strong>Replying to comment</strong>
            <button type="button" class="btn-close" wire:click="cancelReply"></button>
        </div>
    @endif

    <form wire:submit.prevent="submit">
        <div class="mb-3">
            <textarea wire:model="content"
                      class="form-control"
                      rows="3"
                      placeholder="{{ $isReplying ? 'Write your reply...' : 'Share your thoughts on this item...' }}"
                      required></textarea>
            @error('content') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <div class="text-muted small">
                <i class="bi bi-info-circle me-1"></i>
                Be respectful and constructive
            </div>
            <div class="d-flex gap-2">
                @if($isReplying)
                    <button type="button"
                            wire:click="cancelReply"
                            class="btn btn-outline-secondary">
                        Cancel
                    </button>
                @endif
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-send me-1"></i>
                    {{ $isReplying ? 'Post Reply' : 'Post Comment' }}
                </button>
            </div>
        </div>
    </form>
</div>
