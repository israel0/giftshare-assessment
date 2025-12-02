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

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow-sm p-4 mt-5">
            <h4 class="card-title text-center mb-4">Log in</h4>

            @if (session('status'))
                <div class="alert alert-success mb-4">
                    {{ session('status') }}
                </div>
            @endif

            <form wire:submit="login">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                        wire:model="form.email"
                        id="email"
                        class="form-control @error('form.email') is-invalid @enderror"
                        type="email"
                        name="email"
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
                        class="form-control @error('form.password') is-invalid @enderror"
                        type="password"
                        name="password"
                        required
                    >
                    @error('form.password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input wire:model="form.remember" id="remember" type="checkbox" class="form-check-input" name="remember">
                    <label class="form-check-label" for="remember">
                        {{ __('Remember me') }}
                    </label>
                </div>

                <div class="d-flex justify-content-end align-items-center mt-4">
                    @if (Route::has('password.request'))
                        <a class="text-decoration-none me-3 text-primary" href="{{ route('password.request') }}" wire:navigate>
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <button type="submit" class="btn btn-primary">
                        {{ __('Log in') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
