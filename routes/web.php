<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Listings\ListingIndex;
use App\Livewire\Listings\ListingShow;
use App\Livewire\Listings\ListingForm;
use App\Livewire\User\MyListings;


Route::middleware(['auth'])->group(function () {

    Route::get('/', ListingIndex::class)->name('home');
    Route::get('/listings', ListingIndex::class)->name('listings.listing-index');
    Route::get('/listings/{slug}', ListingShow::class)->name('listings.listing-show');

    Route::get('/listing/create', ListingForm::class)->name('listings.listing-create');
    Route::get('/listings/{listing}/edit', ListingForm::class)->name('listings.listing-edit');
    Route::get('/my-listings', MyListings::class)->name('my.listings');

});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware('auth')
    ->name('profile');

require __DIR__.'/auth.php';
