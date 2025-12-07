<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Collection;

class Filters extends Component
{
    public Collection $categories; 
    public array $filters;
    public int $total;

    public function __construct(Collection $categories, array $filters = [], int $total = 0)
    {
        $this->categories = $categories;
        $this->filters = $filters;
        $this->total = $total;
    }

    public function render(): View|Closure|string
    {
        return view('components.listings.filters');
    }
}
