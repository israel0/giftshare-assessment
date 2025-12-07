<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatsCard extends Component
{
  
   public function __construct(
        public $totalListings,
        public $availableCount,
        public $giftedCount
    ) {}

   
    public function render(): View|Closure|string
    {
        return view('components.listings.stats-card');
    }
}
