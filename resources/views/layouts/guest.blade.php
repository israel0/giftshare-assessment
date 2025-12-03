<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <style>
            .app-logo-link {
                color: #495057; /* Default text color */
                text-decoration: none;
                transition: color 0.3s;
            }
            .app-logo-link:hover {
                color: #FF2D20; /* Example hover color */
            }
            .laravel-red {
                color: #FF2D20;
            }
        </style>

        {{-- @vite(['resources/js/app.js']) --}}
        @livewireStyles
    </head>
    <body>

        <div class="justify-content-center align-items-center min-vh-100 py-4 py-sm-5 bg-light">

            <div class="">
                <a href="/" wire:navigate class="app-logo-link text-center d-block">
                    <h1 class="display-6 fw-bold mb-0 text-dark">
                        Gift<span class="text-primary">SharE</span>
                    </h1>

                    </a>
            </div>

            <div >
                <div >
                    {{ $slot }}
                </div>
            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        @livewireScripts
    </body>
</html>
