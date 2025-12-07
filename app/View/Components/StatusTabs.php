<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatusTabs extends Component
{
    public int $availableCount;
    public int $giftedCount;
    public int $totalListings;
    public string $active;

    public function __construct(
        int $availableCount = 0,
        int $giftedCount = 0,
        int $totalListings = 0,
        string $active = 'available'
    ) {
        $this->availableCount = $availableCount;
        $this->giftedCount = $giftedCount;
        $this->totalListings = $totalListings;
        $this->active = $active;
    }

    public function render(): View|Closure|string
    {
        return view('components.listings.status-tabs');
    }
}
