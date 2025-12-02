<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

{{-- NOTE: Alpine.js (x-data) is still necessary for the responsive toggle --}}
<nav x-data="{ open: false }" class="navbar navbar-expand-md navbar-light bg-white border-bottom shadow-sm">
    <div class="container">

        <a class="navbar-brand me-auto" href="/" wire:navigate>
            <h1 class="display-6 fw-bold mb-0 fs-3">
                Gift<span class="text-primary">SharE</span>
            </h1>
        </a>

        <button class="navbar-toggler" type="button" @click="open = ! open" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" :class="{'show': open, 'hidden': ! open}" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    {{-- Use standard Bootstrap nav-link and check active state --}}
                    <a class="nav-link @if(request()->routeIs('dashboard')) active @endif" href="{{ route('dashboard') }}" wire:navigate>
                        {{ __('Dashboard') }}
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile') }}" wire:navigate>
                                {{ __('Profile') }}
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <button wire:click="logout" class="dropdown-item">
                                {{ __('Log Out') }}
                            </button>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
