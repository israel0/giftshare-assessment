<div class="hero-section mb-5 position-relative overflow-hidden">

    <div class="position-absolute top-0 end-0 w-50 h-100 hero-bg"></div>

    <div class="row align-items-center position-relative">
        <div class="col-lg-7">
            <h1 class="display-4 fw-bold text-primary mb-3">
                <i class="bi bi-gift-fill me-3"></i>GiftShare Community
            </h1>

            <p class="lead text-white-80 mb-4">
                Where generosity meets community. Find items you need, share what you don't.
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
            <x-stats-card
                :totalListings="$totalListings"
                :availableCount="$availableCount"
                :giftedCount="$giftedCount"
            />
        </div>
    </div>
</div>
