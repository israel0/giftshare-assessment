@if($listings->count())
    <div class="row g-4">
        @foreach($listings as $listing)
            <div class="col-xl-3 col-lg-4 col-md-6">
                @livewire('listings.listing-card', ['listing' => $listing], key($listing->id))
            </div>
        @endforeach
    </div>

@else
    <x-no-results :filters="$filters" />
@endif
