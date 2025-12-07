@if(
    ($filters['search'] ?? false) ||
    ($filters['category_id'] ?? false) ||
    ($filters['city'] ?? false) ||
    (($filters['status'] ?? 'available') !== 'available') ||
    (($filters['sort'] ?? 'newest') !== 'newest')
)
    <div class="mt-3 pt-3 border-top">
        <small class="text-muted me-2">Active filters:</small>

        {{-- Search --}}
        @if(!empty($filters['search']))
            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 me-2">
                Search: "{{ $filters['search'] }}"
                <button wire:click="$set('filters.search', '')" class="btn btn-link p-0 ms-1 text-primary">
                    <i class="bi bi-x"></i>
                </button>
            </span>
        @endif

        {{-- Category --}}
        @if(!empty($filters['category_id']))
            @php
                $selectedCategory = $categories->find($filters['category_id']);
            @endphp
            @if($selectedCategory)
                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 me-2">
                    Category: {{ $selectedCategory->name }}
                    <button wire:click="$set('filters.category_id', '')" class="btn btn-link p-0 ms-1 text-primary">
                        <i class="bi bi-x"></i>
                    </button>
                </span>
            @endif
        @endif

        {{-- City --}}
        @if(!empty($filters['city']))
            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 me-2">
                City: {{ $filters['city'] }}
                <button wire:click="$set('filters.city', '')" class="btn btn-link p-0 ms-1 text-primary">
                    <i class="bi bi-x"></i>
                </button>
            </span>
        @endif

        {{-- Status --}}
        @if(($filters['status'] ?? 'available') !== 'available')
            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 me-2">
                Status: {{ ucfirst($filters['status']) }}
                <button wire:click="$set('filters.status', 'available')" class="btn btn-link p-0 ms-1 text-primary">
                    <i class="bi bi-x"></i>
                </button>
            </span>
        @endif

        {{-- Sort --}}
        @if(($filters['sort'] ?? 'newest') !== 'newest')
            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 me-2">
                Sort: {{ ucfirst($filters['sort']) }}
                <button wire:click="$set('filters.sort', 'newest')" class="btn btn-link p-0 ms-1 text-primary">
                    <i class="bi bi-x"></i>
                </button>
            </span>
        @endif
    </div>
@endif
