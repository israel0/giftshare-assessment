
@props([
    'label', // e.g., "Total Items"
    'value', // e.g., $totalListings
    'color' => 'white', // Default text color, e.g., 'success', 'info'
    'border' => false,  // Boolean flag to add a right border
])

@php
    // Conditionally apply the border class if the 'border' prop is present and true
    $borderClass = $border ? 'border-end border-white border-opacity-25' : '';
    
    // Determine the text color class
    $colorClass = $color === 'white' ? 'text-white' : 'text-' . $color;
@endphp

<div {{ $attributes->merge(['class' => "col-4 " . $borderClass]) }}>
    <div class="p-2">
        {{-- The value, with dynamic color --}}
        <h3 class="fw-bold {{ $colorClass }} mb-1">{{ $value }}</h3>
        
        {{-- The label --}}
        <small class="text-white-80">{{ $label }}</small>
    </div>
</div>