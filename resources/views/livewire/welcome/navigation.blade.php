<nav class="d-flex flex-grow-1 justify-content-end align-items-center">
    @auth
        <a
            href="{{ url('/dashboard') }}"
            class="btn btn-outline-primary"
        >
            Dashboard
        </a>
    @else
        <a
            href="{{ route('login') }}"
            class="btn btn-link text-dark text-decoration-none me-2"
        >
            Log in
        </a>

        @if (Route::has('register'))
            <a
                href="{{ route('register') }}"
                class="btn btn-primary"
            >
                Register
            </a>
        @endif
    @endauth
</nav>
