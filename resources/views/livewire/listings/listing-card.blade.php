<div class="card listing-card shadow-sm h-100">
    @if($listing->photos->count() > 0)
        <div class="position-relative overflow-hidden" style="height: 200px;">
            <img src="{{ Storage::url($listing->photos->first()->thumbnail_path) }}"
                 alt="{{ $listing->title }}"
                 class="listing-image w-100">
            @if($listing->status === 'gifted')
                <div class="position-absolute top-0 end-0 m-2">
                    <span class="badge badge-gifted px-3 py-2">
                        <i class="bi bi-gift-fill me-1"></i> Gifted
                    </span>
                </div>
            @endif
            <div class="position-absolute bottom-0 start-0 w-100 bg-dark bg-opacity-50 text-white p-2">
                <small><i class="bi bi-geo-alt me-1"></i>{{ $listing->city }}</small>
            </div>
        </div>
    @endif

    <div class="card-body d-flex flex-column">
        <div class="d-flex justify-content-between align-items-start mb-2">
            <h5 class="card-title mb-0">
                <a href="{{ route('listings.listing-show', $listing->slug) }}"
                   class="text-decoration-none text-dark">
                    {{ Str::limit($listing->title, 50) }}
                </a>
            </h5>
            <span class="badge bg-light text-dark border">
                {{ $listing->category->name }}
            </span>
        </div>

        <p class="card-text text-muted small flex-grow-1">
            {{ Str::limit($listing->description, 100) }}
        </p>

        <div class="mt-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($listing->user->name) }}&background=667eea&color=fff"
                         alt="{{ $listing->user->name }}"
                         class="rounded-circle me-2"
                         width="32"
                         height="32">
                    <small class="text-muted">{{ $listing->user->name }}</small>
                </div>
                <small class="text-muted">
                    {{ $listing->created_at->diffForHumans() }}
                </small>
            </div>
        </div>

        <div class="mt-3 pt-3 border-top d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <button wire:click="vote('upvote')"
                        class="btn btn-sm btn-outline-primary me-2 {{ $userVote === 'upvote' ? 'active' : '' }}">
                    <i class="bi bi-hand-thumbs-up"></i>
                    <span class="ms-1">{{ $listing->upvotes_count }}</span>
                </button>
                <button wire:click="vote('downvote')"
                        class="btn btn-sm btn-outline-danger {{ $userVote === 'downvote' ? 'active' : '' }}">
                    <i class="bi bi-hand-thumbs-down"></i>
                    <span class="ms-1">{{ $listing->downvotes_count }}</span>
                </button>
            </div>
            <a href="{{ route('listings.listing-show', $listing->slug) }}"
               class="btn btn-sm btn-outline-primary">
                <i class="bi bi-chat me-1"></i>Comment
            </a>
        </div>
    </div>
</div>
