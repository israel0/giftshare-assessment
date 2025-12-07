<div class="d-flex mb-4 border-bottom">
    <button wire:click="$set('filters.status', 'available')"
            class="btn btn-link text-decoration-none px-3 py-2 {{ $active === 'available' ? 'active border-bottom-2 border-primary text-primary fw-bold' : 'text-muted' }}">
        <i class="bi bi-check-circle me-2"></i>
        Available ({{ $availableCount }})
    </button>

    <button wire:click="$set('filters.status', 'gifted')"
            class="btn btn-link text-decoration-none px-3 py-2 {{ $active === 'gifted' ? 'active border-bottom-2 border-primary text-primary fw-bold' : 'text-muted' }}">
        <i class="bi bi-gift me-2"></i>
        Gifted ({{ $giftedCount }})
    </button>

    <button wire:click="$set('filters.status', 'all')"
            class="btn btn-link text-decoration-none px-3 py-2 {{ $active === 'all' ? 'active border-bottom-2 border-primary text-primary fw-bold' : 'text-muted' }}">
        <i class="bi bi-grid me-2"></i>
        All Items ({{ $totalListings }})
    </button>
</div>
