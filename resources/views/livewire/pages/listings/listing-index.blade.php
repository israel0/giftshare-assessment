<div>
    <div class="container py-4">

        <x-hero
            :totalListings="$totalListings"
            :availableCount="$availableCount"
            :giftedCount="$giftedCount"
        />

        <x-filters
            :categories="$categories"
            :filters="$filters"
            :total="$listings->total()"
        />

        <x-status-tabs
            :availableCount="$availableCount"
            :giftedCount="$giftedCount"
            :totalListings="$totalListings"
            :active="$filters['status']"
        />

        <x-listings.listings-grid 
        :listings="$listings" 
        :filters="$filters" 
        />

        @if($listings->hasPages())
            <div class="mt-5">
                {{ $listings->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
