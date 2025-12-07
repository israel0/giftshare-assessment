<div class="row g-3">

    {{-- Counters --}}
    <div class="col-12">
        <div class="card border-0 shadow-sm glass-card">
            <div class="card-body p-3">
                <div class="row g-0 text-center">

                    <x-stat-box
                        label="Total Items"
                        :value="$totalListings"
                        border
                    />

                    <x-stat-box
                        label="Available Now"
                        :value="$availableCount"
                        color="success"
                        border
                    />

                    <x-stat-box
                        label="Gifted"
                        :value="$giftedCount"
                        color="info"
                    />

                </div>
            </div>
        </div>
    </div>

    {{-- Progress Bar --}}
    <div class="col-12">
        <div class="card border-0 shadow-sm glass-card">
            <div class="card-body p-3">

                @php
                    $rate = $totalListings ? round(($giftedCount / $totalListings) * 100, 1) : 0;
                    $availablePercent = $totalListings ? ($availableCount / $totalListings) * 100 : 0;
                    $giftedPercent = $totalListings ? ($giftedCount / $totalListings) * 100 : 0;
                @endphp

                <div class="d-flex justify-content-between mb-2">
                    <small class="text-white-80">Community Giving Progress</small>
                    <small class="text-white-80 fw-bold">{{ $rate }}% Success Rate</small>
                </div>

                <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-success" style="width: {{ $availablePercent }}%"></div>
                    <div class="progress-bar bg-info" style="width: {{ $giftedPercent }}%"></div>
                </div>

            </div>
        </div>
    </div>

</div>
