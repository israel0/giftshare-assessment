<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 text-dark mb-0">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4 py-lg-5"> <div class="container-fluid max-w-7xl mx-auto px-sm-3 px-lg-4"> <div class="card shadow-sm">
                <div class="card-body p-4 text-dark">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
