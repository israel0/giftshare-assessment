<div class="card shadow-sm mb-4 border-0">
    <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-dark">
            <i class="bi bi-funnel me-2"></i>Find Perfect Items
        </h5>
        <small class="text-muted">{{ $total }}</small>
    </div>

    <div class="card-body p-4">
        {{-- Inputs --}}
        @include('components.listings.filters.inputs')

        {{-- Active Filters --}}
        @include('components.listings.filters.active', [
            'filters' => $filters,
            'categories' => $categories
        ])
    </div>
</div>
