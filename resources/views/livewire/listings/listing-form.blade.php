<div>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-0 py-4">
                        <h2 class="h3 mb-0 text-center">
                            <i class="bi bi-gift me-2"></i>
                            {{ $isEdit ? 'Edit Listing' : 'Share an Item' }}
                        </h2>
                    </div>

                    <div class="card-body p-4">
                        @if(session('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle me-2"></i>
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form wire:submit.prevent="save">
                            <!-- Title -->
                            <div class="mb-4">
                                <label for="title" class="form-label fw-bold">Item Title *</label>
                                <input type="text"
                                       wire:model="title"
                                       class="form-control form-control-lg"
                                       id="title"
                                       placeholder="What are you giving away?">
                                @error('title') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <!-- Description -->
                            <div class="mb-4">
                                <label for="description" class="form-label fw-bold">Description *</label>
                                <textarea wire:model="description"
                                          class="form-control"
                                          id="description"
                                          rows="5"
                                          placeholder="Describe the item, its condition, and why you're giving it away..."></textarea>
                                @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <!-- Category & Location -->
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="category" class="form-label fw-bold">Category *</label>
                                    <select wire:model="category_id"
                                            class="form-select"
                                            id="category">
                                        <option value="">Select a category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="city" class="form-label fw-bold">City *</label>
                                    <input type="text"
                                           wire:model="city"
                                           class="form-control"
                                           id="city"
                                           placeholder="Where is the item located?">
                                    @error('city') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Weight & Dimensions -->
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="weight" class="form-label fw-bold">
                                        <i class="bi bi-weight me-1"></i>Weight (kg)
                                    </label>
                                    <input type="number"
                                           wire:model="weight"
                                           class="form-control"
                                           id="weight"
                                           step="0.1"
                                           min="0"
                                           placeholder="Optional">
                                    @error('weight') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="dimensions" class="form-label fw-bold">
                                        <i class="bi bi-rulers me-1"></i>Dimensions
                                    </label>
                                    <input type="text"
                                           wire:model="dimensions"
                                           class="form-control"
                                           id="dimensions"
                                           placeholder="e.g., 10x20x30 cm">
                                    @error('dimensions') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Photos Upload -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">
                                    <i class="bi bi-images me-1"></i>Photos
                                </label>
                                <div class="mb-3">
                                    <input type="file"
                                           wire:model="photos"
                                           class="form-control"
                                           accept="image/*"
                                           multiple>
                                    <div class="form-text">Upload up to 5 photos (max 2MB each)</div>
                                    @error('photos.*') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <!-- Uploaded Photos Preview -->
                                @if(count($photos) > 0)
                                    <div class="mb-3">
                                        <h6 class="fw-bold mb-2">New Photos:</h6>
                                        <div class="row g-2">
                                            @foreach($photos as $index => $photo)
                                                <div class="col-md-3">
                                                    <div class="position-relative">
                                                        <img src="{{ $photo->temporaryUrl() }}"
                                                             class="img-thumbnail"
                                                             style="height: 100px; width: 100%; object-fit: cover;">
                                                        <button type="button"
                                                                wire:click="removeUploadedPhoto({{ $index }})"
                                                                class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1"
                                                                style="width: 24px; height: 24px; padding: 0;">
                                                            <i class="bi bi-x"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- Existing Photos -->
                                @if($isEdit && $existingPhotos->count() > 0)
                                    <div class="mb-3">
                                        <h6 class="fw-bold mb-2">Current Photos:</h6>
                                        <div class="row g-2">
                                            @foreach($existingPhotos as $photo)
                                                <div class="col-md-3">
                                                    <div class="position-relative">
                                                        <img src="{{ Storage::url($photo->thumbnail_path) }}"
                                                             class="img-thumbnail"
                                                             style="height: 100px; width: 100%; object-fit: cover;">
                                                        <button type="button"
                                                                wire:click="removeExistingPhoto({{ $photo->id }})"
                                                                class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1"
                                                                style="width: 24px; height: 24px; padding: 0;">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Submit Buttons -->
                            <div class="d-flex justify-content-between pt-3 border-top">
                                <a href="{{ $isEdit ? route('listings.show', $listing->slug) : route('listings.listing-index') }}"
                                   class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-1"></i>Cancel
                                </a>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-{{ $isEdit ? 'check-circle' : 'gift' }} me-1"></i>
                                    {{ $isEdit ? 'Update Listing' : 'Share Item' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            // Confirm before leaving page with unsaved changes
            window.addEventListener('beforeunload', function (e) {
                if (@this.isDirty) {
                    e.preventDefault();
                    e.returnValue = '';
                }
            });
        });
    </script>
    @endpush
</div>
