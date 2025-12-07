<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Hero extends Component
{
   
    public function __construct(
        public $totalListings = 0, 
        public $availableCount = 0, 
        public $giftedCount = 0
    ) {}

  
    public function render(): View|Closure|string
    {
        return view('components.listings.hero');
    }
}