<div>
    <div class="container py-4">
        <!-- Enhanced Hero Section with Status Stats -->
        <div class="hero-section mb-5 position-relative overflow-hidden">
            <div class="position-absolute top-0 end-0 w-50 h-100">
                <div class="w-100 h-100" style="
                    background: url('https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');
                    background-size: cover;
                    background-position: center;
                    opacity: 0.1;
                    border-radius: 0 1rem 1rem 0;
                "></div>
            </div>

            <div class="row align-items-center position-relative">
                <div class="col-lg-7">
                    <h1 class="display-4 fw-bold text-primary mb-3">
                        <i class="bi bi-gift-fill me-3"></i>GiftShare Community
                    </h1>
                    <p class="lead text-white-80 mb-4">
                        Where generosity meets community. Find items you need, share what you don't.
                        Every gift shared makes our community stronger.
                    </p>
                    @auth
                        <a href="{{ route('listings.listing-create') }}" class="btn btn-primary btn-lg px-4 shadow-sm">
                            <i class="bi bi-plus-circle me-2"></i>Share an Item
                        </a>
                    @else
                        <div class="d-flex gap-3">
                            <a href="{{ route('login') }}" class="btn btn-light btn-lg px-4 shadow-sm">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login to Share
                            </a>
                            <a href="{{ route('listings.index') }}" class="btn btn-outline-light btn-lg px-4">
                                <i class="bi bi-binoculars me-2"></i>Browse Items
                            </a>
                        </div>
                    @endauth
                </div>
                <div class="col-lg-5">
                    <!-- Status Stats Cards -->
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm bg-white bg-opacity-10 backdrop-blur">
                                <div class="card-body p-3">
                                    <div class="row g-0 text-center">
                                        <div class="col-4 border-end border-white border-opacity-25">
                                            <div class="p-2">
                                                <h3 class="fw-bold text-white mb-1">{{ $totalListings }}</h3>
                                                <small class="text-white-80">Total Items</small>
                                            </div>
                                        </div>
                                        <div class="col-4 border-end border-white border-opacity-25">
                                            <div class="p-2">
                                                <h3 class="fw-bold text-success mb-1">{{ $availableCount }}</h3>
                                                <small class="text-white-80">Available Now</small>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="p-2">
                                                <h3 class="fw-bold text-info mb-1">{{ $giftedCount }}</h3>
                                                <small class="text-white-80">Successfully Gifted</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Status Progress Bar -->
                        <div class="col-12">
                            <div class="card border-0 shadow-sm bg-white bg-opacity-10 backdrop-blur">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <small class="text-white-80">Community Giving Progress</small>
                                        <small class="text-white-80 fw-bold">
                                            {{ $totalListings > 0 ? round(($giftedCount / $totalListings) * 100, 1) : 0 }}% Success Rate
                                        </small>
                                    </div>
                                    <div class="progress" style="height: 8px;">
                                        @php
                                            $availablePercentage = $totalListings > 0 ? ($availableCount / $totalListings) * 100 : 0;
                                            $giftedPercentage = $totalListings > 0 ? ($giftedCount / $totalListings) * 100 : 0;
                                        @endphp
                                        <div class="progress-bar bg-success"
                                             style="width: {{ $availablePercentage }}%"
                                             role="progressbar"
                                             title="{{ $availableCount }} Available">
                                        </div>
                                        <div class="progress-bar bg-info"
                                             style="width: {{ $giftedPercentage }}%"
                                             role="progressbar"
                                             title="{{ $giftedCount }} Gifted">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <small class="text-white-80">
                                            <span class="badge bg-success me-1" style="width: 8px; height: 8px;"></span>
                                            Available
                                        </small>
                                        <small class="text-white-80">
                                            <span class="badge bg-info me-1" style="width: 8px; height: 8px;"></span>
                                            Gifted
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Filters Card -->
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-header bg-white border-0 py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-white">
                        <i class="bi bi-funnel me-2"></i>Find Perfect Items
                    </h5>
                    <small class="text-muted">{{ $listings->total() }} items found</small>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-search text-muted"></i>
                            </span>
                            <input type="text"
                                   wire:model.live.debounce.300ms="filters.search"
                                   class="form-control border-start-0"
                                   placeholder="Search items...">
                        </div>
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
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-geo-alt text-muted"></i>
                            </span>
                            <input type="text"
                                   wire:model.live.debounce.300ms="filters.city"
                                   class="form-control border-start-0"
                                   placeholder="City">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <select wire:model.live="filters.status" class="form-select">
                            <option value="available">Available</option>
                            <option value="gifted">Gifted</option>
                            <option value="all">All Status</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select wire:model.live="filters.sort" class="form-select">
                            <option value="newest">Newest First</option>
                            <option value="oldest">Oldest First</option>
                            <option value="upvotes">Most Upvoted</option>
                            <option value="comments">Most Comments</option>
                        </select>
                    </div>

                    <div class="col-md-1">
                        <button wire:click="resetFilters"
                                class="btn btn-outline-primary w-100"
                                title="Reset all filters">
                            <i class="bi bi-arrow-clockwise"></i>
                            Reset
                        </button>
                    </div>
                </div>

                <!-- Active Filters Display -->
                @if($filters['search'] || $filters['category_id'] || $filters['city'] || $filters['status'] !== 'available' || $filters['sort'] !== 'newest')
                    <div class="mt-3 pt-3 border-top">
                        <small class="text-muted me-2">Active filters:</small>
                        @if($filters['search'])
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 me-2">
                                Search: "{{ $filters['search'] }}"
                                <button wire:click="$set('filters.search', '')" class="btn btn-link p-0 ms-1 text-primary">
                                    <i class="bi bi-x"></i>
                                </button>
                            </span>
                        @endif
                        @if($filters['category_id'])
                            @php $selectedCategory = $categories->find($filters['category_id']); @endphp
                            @if($selectedCategory)
                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 me-2">
                                    Category: {{ $selectedCategory->name }}
                                    <button wire:click="$set('filters.category_id', '')" class="btn btn-link p-0 ms-1 text-primary">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </span>
                            @endif
                        @endif
                        @if($filters['city'])
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 me-2">
                                City: {{ $filters['city'] }}
                                <button wire:click="$set('filters.city', '')" class="btn btn-link p-0 ms-1 text-primary">
                                    <i class="bi bi-x"></i>
                                </button>
                            </span>
                        @endif
                        @if($filters['status'] !== 'available')
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 me-2">
                                Status: {{ ucfirst($filters['status']) }}
                                <button wire:click="$set('filters.status', 'available')" class="btn btn-link p-0 ms-1 text-primary">
                                    <i class="bi bi-x"></i>
                                </button>
                            </span>
                        @endif
                        @if($filters['sort'] !== 'newest')
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 me-2">
                                Sort: {{ ucfirst($filters['sort']) }}
                                <button wire:click="$set('filters.sort', 'newest')" class="btn btn-link p-0 ms-1 text-primary">
                                    <i class="bi bi-x"></i>
                                </button>
                            </span>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <!-- Status Tabs -->
        <div class="d-flex mb-4 border-bottom">
            <button wire:click="$set('filters.status', 'available')"
                    class="btn btn-link text-decoration-none px-3 py-2 {{ $filters['status'] === 'available' ? 'active border-bottom-2 border-primary text-primary fw-bold' : 'text-muted' }}">
                <i class="bi bi-check-circle me-2"></i>
                Available ({{ $availableCount }})
            </button>
            <button wire:click="$set('filters.status', 'gifted')"
                    class="btn btn-link text-decoration-none px-3 py-2 {{ $filters['status'] === 'gifted' ? 'active border-bottom-2 border-primary text-primary fw-bold' : 'text-muted' }}">
                <i class="bi bi-gift me-2"></i>
                Gifted ({{ $giftedCount }})
            </button>
            <button wire:click="$set('filters.status', 'all')"
                    class="btn btn-link text-decoration-none px-3 py-2 {{ $filters['status'] === 'all' ? 'active border-bottom-2 border-primary text-primary fw-bold' : 'text-muted' }}">
                <i class="bi bi-grid me-2"></i>
                All Items ({{ $totalListings }})
            </button>
        </div>

        <!-- Listings Grid -->
        @if($listings->count() > 0)
            <div class="row g-4">
                @foreach($listings as $listing)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        @livewire('listings.listing-card', ['listing' => $listing], key($listing->id))
                    </div>
                @endforeach
            </div>
        @else
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <i class="bi bi-inbox display-1 text-muted"></i>
                    </div>
                    <h4 class="text-muted mb-3">No items found</h4>
                    <p class="text-muted mb-4">
                        @if($filters['status'] === 'gifted')
                            No gifted items yet. Be the first to mark an item as gifted!
                        @elseif($filters['status'] === 'all')
                            No items in the community yet.
                        @else
                            No available items match your filters.
                        @endif
                    </p>
                    @if($filters['search'] || $filters['category_id'] || $filters['city'] || $filters['status'] !== 'available')
                        <button wire:click="resetFilters" class="btn btn-primary">
                            <i class="bi bi-arrow-clockwise me-2"></i>Clear Filters
                        </button>
                    @else
                        @auth
                            <a href="{{ route('listings.listing-create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-2"></i>Be the First to Share
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login to Share
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        @endif

        <!-- Pagination -->
        @if($listings->hasPages())
            <div class="mt-5">
                {{ $listings->links('pagination::bootstrap-5') }}
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
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.1) 0%, transparent 50%);
        }

        .text-white-80 {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .backdrop-blur {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .border-bottom-2 {
            border-bottom-width: 3px !important;
        }

        .progress-bar.bg-success {
            background: linear-gradient(90deg, #20c997, #17a2b8) !important;
        }

        .progress-bar.bg-info {
            background: linear-gradient(90deg, #17a2b8, #0dcaf0) !important;
        }

        .listing-card {
            transition: all 0.3s ease;
            border: none;
            overflow: hidden;
            border-radius: 12px;
        }

        .listing-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(102, 126, 234, 0.15) !important;
        }

        .badge-gifted {
            background: linear-gradient(135deg, #20c997, #17a2b8);
            color: white;
            font-weight: 500;
        }

        .badge-available {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            font-weight: 500;
        }

        .active-filters .badge {
            transition: all 0.2s ease;
        }

        .active-filters .badge:hover {
            transform: scale(1.05);
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            // Smooth scroll to top when filters change
            Livewire.on('filtersUpdated', () => {
                window.scrollTo({ top: 400, behavior: 'smooth' });
            });
        });
    </script>
    @endpush
</div>
