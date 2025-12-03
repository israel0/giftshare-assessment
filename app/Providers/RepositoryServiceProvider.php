<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\ListingRepositoryInterface;
use App\Repositories\Contracts\VoteRepositoryInterface;
use App\Repositories\ListingRepository;
use App\Repositories\VoteRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ListingRepositoryInterface::class, ListingRepository::class);
        $this->app->bind(VoteRepositoryInterface::class, VoteRepository::class);
    }

    public function boot(): void
    {
        
    }
}
