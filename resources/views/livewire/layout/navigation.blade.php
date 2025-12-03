<nav x-data="{ open: false }" class="navbar navbar-expand-md navbar-light bg-white border-bottom shadow-sm">
    <div class="container">

        {{-- Brand --}}
        <a class="navbar-brand me-auto" href="/" wire:navigate>
            <h1 class="display-6 fw-bold mb-0 fs-3">
                Gift<span class="text-primary">SharE</span>
            </h1>
        </a>

        {{-- Hamburger --}}
        <button class="navbar-toggler" type="button" @click="open = !open"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Navbar links --}}
        <div class="collapse navbar-collapse" :class="{'show': open, 'hidden': !open}" id="navbarSupportedContent">


            {{-- Right links --}}
            <ul class="navbar-nav ms-auto">
                @if(auth()->check())
                    <li class="nav-item dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="userDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            <div x-data="{ name: '{{ auth()->user()->name }}' }" x-text="name"></div>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile') }}" wire:navigate>
                                    {{ __('Profile') }}
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <livewire:user.logout-button />
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            {{ __('Log In') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-white ms-2" href="{{ route('register') }}">
                            {{ __('Register') }}
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
