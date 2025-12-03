<div>
    <div class="container py-4">
        <!-- Hero Section -->
        <div class="hero-section mb-5">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold text-primary mb-3">GiftShare Community</h1>
                    <p class="lead text-muted mb-4">
                        Discover items shared by your community. Find what you need, give what you don't.
                    </p>
                    @auth
                        <a href="{{ route('listings.listing-create') }}" class="btn btn-primary btn-lg px-4">
                            <i class="bi bi-plus-circle me-2"></i>Share an Item
                        </a>
                    @endauth
                </div>
                <div class="col-lg-4 text-lg-end">
                    <div class="stats-card card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-6">
                                    <h3 class="fw-bold text-primary">{{ $totalListings ?? 0 }}</h3>
                                    <small class="text-muted">Items Shared</small>
                                </div>
                                <div class="col-6">
                                    <h3 class="fw-bold text-success">{{ $giftedCount ?? 0 }}</h3>
                                    <small class="text-muted">Items Gifted</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters Card -->
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-md-3">
                        <input type="text"
                               wire:model.live.debounce.300ms="filters.search"
                               class="form-control"
                               placeholder="Search items...">
                    </div>
                    <div class="col-md-2">
                        <select wire:model.live="filters.category_id" class="form-select">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="text"
                               wire:model.live.debounce.300ms="filters.city"
                               class="form-control"
                               placeholder="City">
                    </div>
                    <div class="col-md-2">
                        <select wire:model.live="filters.status" class="form-select">
                            <option value="available">Available</option>
                            <option value="gifted">Gifted</option>
                            <option value="all">All</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select wire:model.live="filters.sort" class="form-select">
                            <option value="newest">Newest First</option>
                            <option value="oldest">Oldest First</option>
                            <option value="upvotes">Most Upvoted</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button wire:click="resetFilters" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-arrow-clockwise"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Listings Grid -->
        <div class="row g-4">
            @forelse($listings as $listing)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    @livewire('listings.listing-card', ['listing' => $listing], key($listing->id))
                </div>
            @empty
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center py-5">
                            <i class="bi bi-inbox display-1 text-muted mb-3"></i>
                            <h4 class="text-muted">No items found</h4>
                            <p class="text-muted">Try adjusting your filters or be the first to share an item!</p>
                            @auth
                                <a href="{{ route('listings.listing-create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle me-2"></i>Share an Item
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($listings->hasPages())
            <div class="mt-5">
                {{ $listings->links() }}
            </div>
        @endif
    </div>

    @push('styles')
    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 3rem;
            border-radius: 1rem;
            color: white;
        }

        .hero-section h1, .hero-section p {
            color: white !important;
        }

        .hero-section .btn-primary {
            background: white;
            color: #667eea;
            border: none;
        }

        .hero-section .btn-primary:hover {
            background: #f8f9fa;
        }

        .stats-card {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 0.75rem;
        }

        .listing-card {
            transition: transform 0.2s, box-shadow 0.2s;
            border: none;
            overflow: hidden;
        }

        .listing-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }

        .listing-image {
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .listing-card:hover .listing-image {
            transform: scale(1.05);
        }

        .badge-gifted {
            background: linear-gradient(135deg, #20c997, #17a2b8);
            color: white;
        }
    </style>
    @endpush
</div>

