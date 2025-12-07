<div class="card-body p-4">
    <div class="row g-3">
        {{-- Search Input --}}
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
        
        {{-- Category Dropdown --}}
        <div class="col-md-2">
            <select wire:model.live="filters.category_id" class="form-select">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        
        {{-- City/Location Input --}}
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
        
        {{-- Status Dropdown --}}
        <div class="col-md-2">
            <select wire:model.live="filters.status" class="form-select">
                <option value="available">Available</option>
                <option value="gifted">Gifted</option>
                <option value="all">All Status</option>
            </select>
        </div>
        
        {{-- Sort By Dropdown --}}
        <div class="col-md-2">
            <select wire:model.live="filters.sort" class="form-select">
                <option value="newest">Newest First</option>
                <option value="oldest">Oldest First</option>
                <option value="upvotes">Most Upvoted</option>
                <option value="comments">Most Comments</option>
            </select>
        </div>
        
        {{-- Reset Filters Button --}}
        <div class="col-md-1">
            <button wire:click="resetFilters"
                    class="btn btn-outline-primary w-100"
                    title="Reset all filters">
                <i class="bi bi-arrow-clockwise"></i>
                Reset
            </button>
        </div>
    </div>
</div>