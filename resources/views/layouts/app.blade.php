<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <link rel="stylesheet" href="{{ asset("css/enhanced.css") }}">

        @livewireStyles

    </head>
    <body class="font-sans antialiased">
        <div class="min-vh-100 d-flex flex-column bg-light">
            @include('livewire.layout.navigation')

            @isset($header)
                <header class="bg-white shadow">
                    <div class="container py-3">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="flex-grow-1">
                <div class="container py-4">
                    {{ $slot }}
                </div>
            </main>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

        @livewireScripts
    </body>
</html>
