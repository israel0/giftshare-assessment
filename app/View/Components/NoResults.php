<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NoResults extends Component
{
   
    public function __construct()
    {
        //
    }

   
    public function render(): View|Closure|string
    {
        return view('components.listings.no-results');
    }
}
