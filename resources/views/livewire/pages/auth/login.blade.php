<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('listings.listing-index', absolute: false), navigate: true);
    }
};
?>

<div class="container py-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6 d-none d-md-flex justify-content-center">
            <img src="{{ asset('images/gift-box.jpg') }}" alt="GiftShare Login" class="img-fluid" style="max-height: 400px;">
        </div>

        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg rounded-4 p-4 p-md-5 border-0">
                <h3 class="text-center mb-4 fw-bold">Welcome Back</h3>
                <p class="text-center text-muted mb-4">
                    Enter your email and password to access your GiftShare account
                </p>

                @if (session('status'))
                    <div class="alert alert-success mb-4">
                        {{ session('status') }}
                    </div>
                @endif

                <form wire:submit="login" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input
                            wire:model="form.email"
                            id="email"
                            type="email"
                            class="form-control @error('form.email') is-invalid @enderror"
                            placeholder="your@email.com"
                            required
                            autofocus
                        >
                        @error('form.email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input
                            wire:model="form.password"
                            id="password"
                            type="password"
                            class="form-control @error('form.password') is-invalid @enderror"
                            placeholder="********"
                            required
                        >
                        @error('form.password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input wire:model="form.remember" id="remember" type="checkbox" class="form-check-input">
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-decoration-none text-primary small" wire:navigate>
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                        Log in
                    </button>
                </form>

                <p class="text-center text-muted mt-4 mb-0 small">
                    Don’t have an account?
                    <a href="{{ route('register') }}" class="text-decoration-none fw-bold text-primary" wire:navigate>
                        Create one
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
