<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Collection;

class ListingsGrid extends Component
{
    public Collection $listings;
    public array $filters;

    public function __construct($listings, $filters = [])
    {
        $this->listings = $listings;
        $this->filters = $filters;
    }

    public function render()
    {
        return view('components.listings.listings-grid');
    }
}
