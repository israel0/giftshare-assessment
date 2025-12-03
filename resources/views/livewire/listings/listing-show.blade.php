<div>
    <div class="container py-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('listings.listing-index') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $listing->title }}</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Left Column - Images -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4">
                    @if($listing->photos->count() > 0)
                        <div id="listingCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($listing->photos as $key => $photo)
                                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                        <img src="{{ Storage::url($photo->path) }}"
                                             class="d-block w-100"
                                             alt="{{ $listing->title }}"
                                             style="height: 500px; object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>
                            @if($listing->photos->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#listingCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#listingCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            @endif
                        </div>

                        <!-- Thumbnails -->
                        @if($listing->photos->count() > 1)
                            <div class="p-3">
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($listing->photos as $key => $photo)
                                        <a href="#"
                                           data-bs-target="#listingCarousel"
                                           data-bs-slide-to="{{ $key }}"
                                           class="{{ $key === 0 ? 'active' : '' }}">
                                            <img src="{{ Storage::url($photo->thumbnail_path) }}"
                                                 class="rounded"
                                                 width="80"
                                                 height="80"
                                                 style="object-fit: cover; cursor: pointer;">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endif

                    <!-- Listing Details -->
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                @if($listing->status === 'gifted')
                                    <span class="badge badge-gifted px-3 py-2 mb-2">
                                        <i class="bi bi-gift-fill me-1"></i> Already Gifted
                                    </span>
                                @endif
                                <h1 class="h2 fw-bold mb-2">{{ $listing->title }}</h1>
                            </div>
                            <div class="d-flex gap-2">
                                @if(auth()->id() === $listing->user_id)
                                    <a href="{{ route('listings.listing-edit', $listing->id) }}"
                                       class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-pencil me-1"></i>Edit
                                    </a>
                                    @if($listing->status !== 'gifted')
                                        <button wire:click="markAsGifted"
                                                wire:confirm="Mark this item as gifted?"
                                                class="btn btn-success btn-sm">
                                            <i class="bi bi-gift me-1"></i>Mark as Gifted
                                        </button>
                                    @endif
                                    <button wire:click="deleteListing"
                                            wire:confirm="Are you sure you want to delete this listing?"
                                            class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash me-1"></i>Delete
                                    </button>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-person-circle text-primary me-2 fs-5"></i>
                                    <div>
                                        <small class="text-muted d-block">Posted by</small>
                                        <strong>{{ $listing->user->name }}</strong>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-geo-alt text-primary me-2 fs-5"></i>
                                    <div>
                                        <small class="text-muted d-block">Location</small>
                                        <strong>{{ $listing->city }}</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-grid text-primary me-2 fs-5"></i>
                                    <div>
                                        <small class="text-muted d-block">Category</small>
                                        <strong>{{ $listing->category->name }}</strong>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-calendar text-primary me-2 fs-5"></i>
                                    <div>
                                        <small class="text-muted d-block">Posted</small>
                                        <strong>{{ $listing->created_at->format('M d, Y') }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="mb-4">
                            <h5 class="fw-bold mb-3">Description</h5>
                            <p class="mb-0" style="white-space: pre-line;">{{ $listing->description }}</p>
                        </div>

                        @if($listing->weight || $listing->dimensions)
                            <div class="row">
                                @if($listing->weight)
                                    <div class="col-md-6">
                                        <h6 class="fw-bold mb-2">Weight</h6>
                                        <p class="text-muted">{{ $listing->weight }} kg</p>
                                    </div>
                                @endif
                                @if($listing->dimensions)
                                    <div class="col-md-6">
                                        <h6 class="fw-bold mb-2">Dimensions</h6>
                                        <p class="text-muted">{{ $listing->dimensions }}</p>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Voting Section -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">Community Feedback</h5>
                        @livewire('interactions.votes', ['listing' => $listing], key('votes-' . $listing->id))
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-chat-left-text me-2"></i>
                            Comments ({{ $listing->comments_count }})
                        </h5>
                        @livewire('interactions.comments', ['listing' => $listing], key('comments-' . $listing->id))
                    </div>
                </div>
            </div>

            <!-- Right Column - Sidebar -->
            <div class="col-lg-4">
                <!-- User Card -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4 text-center">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($listing->user->name) }}&background=667eea&color=fff&size=128"
                             alt="{{ $listing->user->name }}"
                             class="rounded-circle mb-3 border border-4 border-primary"
                             width="128"
                             height="128">
                        <h5 class="fw-bold mb-1">{{ $listing->user->name }}</h5>
                        <p class="text-muted mb-3">Community Member</p>
                        <a href="mailto:{{ $listing->user->email }}" class="btn btn-outline-primary w-100 mb-2">
                            <i class="bi bi-envelope me-2"></i>Contact User
                        </a>
                        <button class="btn btn-outline-secondary w-100">
                            <i class="bi bi-share me-2"></i>Share Listing
                        </button>
                    </div>
                </div>

                <!-- Stats Card -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3">Listing Stats</h6>
                        <div class="row text-center">
                            <div class="col-6 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="bi bi-eye display-6 text-primary mb-2"></i>
                                    <h4 class="fw-bold">{{ $listing->views_count ?? 0 }}</h4>
                                    <small class="text-muted">Views</small>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="bi bi-chat-left-text display-6 text-primary mb-2"></i>
                                    <h4 class="fw-bold">{{ $listing->comments_count }}</h4>
                                    <small class="text-muted">Comments</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 bg-light rounded">
                                    <i class="bi bi-hand-thumbs-up display-6 text-success mb-2"></i>
                                    <h4 class="fw-bold">{{ $listing->upvotes_count }}</h4>
                                    <small class="text-muted">Upvotes</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 bg-light rounded">
                                    <i class="bi bi-hand-thumbs-down display-6 text-danger mb-2"></i>
                                    <h4 class="fw-bold">{{ $listing->downvotes_count }}</h4>
                                    <small class="text-muted">Downvotes</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Safety Tips -->
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3"><i class="bi bi-shield-check me-2"></i>Safety Tips</h6>
                        <ul class="list-unstyled text-muted small">
                            <li class="mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                Meet in public places
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                Bring a friend if possible
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                Inspect items before accepting
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                Trust your instincts
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                Report suspicious activity
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .badge-gifted {
            background: linear-gradient(135deg, #20c997, #17a2b8);
            color: white;
            font-weight: 500;
        }

        .carousel-item img {
            border-radius: 0.375rem 0.375rem 0 0;
        }

        .btn-outline-primary.active {
            background-color: #0d6efd;
            color: white;
        }

        .btn-outline-danger.active {
            background-color: #dc3545;
            color: white;
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('voteUpdated', () => {
                // Optional: Add vote animation
                const votes = document.querySelector('.votes-section');
                if (votes) {
                    votes.classList.add('animate__animated', 'animate__pulse');
                    setTimeout(() => {
                        votes.classList.remove('animate__animated', 'animate__pulse');
                    }, 1000);
                }
            });
        });
    </script>
    @endpush
</div>
