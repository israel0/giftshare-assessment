<div>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="display-6 fw-bold">My Listings</h1>
                <p class="text-muted">Manage your shared items</p>
            </div>
            <a href="{{ route('listings.listing-create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>New Listing
            </a>
        </div>

        @if(session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-3">
                <!-- Stats Sidebar -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">My Stats</h6>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item border-0 px-0 py-2">
                                <div class="d-flex justify-content-between">
                                    <span>Total Listings</span>
                                    <strong>{{ $listings->total() }}</strong>
                                </div>
                            </div>
                            <div class="list-group-item border-0 px-0 py-2">
                                <div class="d-flex justify-content-between">
                                    <span>Available</span>
                                    <strong class="text-success">{{ $listings->where('status', 'available')->count() }}</strong>
                                </div>
                            </div>
                            <div class="list-group-item border-0 px-0 py-2">
                                <div class="d-flex justify-content-between">
                                    <span>Gifted</span>
                                    <strong class="text-primary">{{ $listings->where('status', 'gifted')->count() }}</strong>
                                </div>
                            </div>
                            <div class="list-group-item border-0 px-0 py-2">
                                <div class="d-flex justify-content-between">
                                    <span>Total Upvotes</span>
                                    <strong class="text-warning">{{ $listings->sum('upvotes_count') }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <!-- Listings Table -->
                <div class="card shadow-sm border-0">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0">Item</th>
                                        <th class="border-0">Status</th>
                                        <th class="border-0">Votes</th>
                                        <th class="border-0">Comments</th>
                                        <th class="border-0">Created</th>
                                        <th class="border-0 text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($listings as $listing)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($listing->photos->count() > 0)
                                                        <img src="{{ Storage::url($listing->photos->first()->thumbnail_path) }}"
                                                             alt="{{ $listing->title }}"
                                                             class="rounded me-3"
                                                             width="60"
                                                             height="60"
                                                             style="object-fit: cover;">
                                                    @endif
                                                    <div>
                                                        <strong class="d-block">{{ $listing->title }}</strong>
                                                        <small class="text-muted">{{ $listing->category->name }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($listing->status === 'gifted')
                                                    <span class="badge bg-primary">Gifted</span>
                                                @else
                                                    <span class="badge bg-success">Available</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="text-success">
                                                        <i class="bi bi-hand-thumbs-up"></i> {{ $listing->upvotes_count }}
                                                    </span>
                                                    <span class="text-danger">
                                                        <i class="bi bi-hand-thumbs-down"></i> {{ $listing->downvotes_count }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <i class="bi bi-chat-text me-1"></i>
                                                {{ $listing->comments_count }}
                                            </td>
                                            <td>
                                                <small>{{ $listing->created_at->format('M d, Y') }}</small>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-end gap-2">
                                                    <a href="{{ route('listings.listing-show', $listing->slug) }}"
                                                       class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('listings.listing-edit', $listing->id) }}"
                                                       class="btn btn-sm btn-outline-secondary">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    @if($listing->status !== 'gifted')
                                                        <button wire:click="markAsGifted({{ $listing->id }})"
                                                                wire:confirm="Mark this item as gifted?"
                                                                class="btn btn-sm btn-outline-success"
                                                                title="Mark as Gifted">
                                                            <i class="bi bi-gift"></i>
                                                        </button>
                                                    @endif
                                                    <button wire:click="deleteListing({{ $listing->id }})"
                                                            wire:confirm="Delete this listing?"
                                                            class="btn btn-sm btn-outline-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-5">
                                                <i class="bi bi-inbox display-1 text-muted mb-3"></i>
                                                <h5 class="text-muted">No listings yet</h5>
                                                <p class="text-muted mb-0">Start by sharing your first item!</p>
                                                <a href="{{ route('listings.listing-create') }}" class="btn btn-primary mt-3">
                                                    <i class="bi bi-plus-circle me-2"></i>Create Listing
                                                </a>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                @if($listings->hasPages())
                    <div class="mt-4">
                        {{ $listings->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
