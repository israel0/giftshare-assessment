<x-app-layout>


    <div class="py-4 py-lg-5"> <div class="container-fluid px-sm-3 px-lg-4"> <div class="row g-4 justify-content-center"> <div class="col-lg-8"> <div class="card shadow-sm">
                        <div class="card-body p-4 p-sm-5">
                            <livewire:profile.update-profile-information-form />
                        </div>
                    </div>
                </div>

                <div class="col-lg-8"> <div class="card shadow-sm">
                        <div class="card-body p-4 p-sm-5">
                            <livewire:profile.update-password-form />
                        </div>
                    </div>
                </div>

                <div class="col-lg-8"> <div class="card shadow-sm">
                        <div class="card-body p-4 p-sm-5">
                            <livewire:profile.delete-user-form />
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
