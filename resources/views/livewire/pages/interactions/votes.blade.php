<div class="votes-section">
    <div class="d-flex align-items-center gap-4">
        <!-- Upvote Button -->
        <div class="text-center">
            <button wire:click="vote('upvote')"
                    class="btn btn-lg btn-outline-success border-0 p-3 rounded-circle {{ $userVote === 'upvote' ? 'active bg-success text-white' : '' }}"
                    title="Upvote">
                <i class="bi bi-hand-thumbs-up fs-3"></i>
            </button>
            <div class="mt-2">
                <span class="fw-bold fs-5 {{ $userVote === 'upvote' ? 'text-success' : 'text-dark' }}">
                    {{ $upvotesCount }}
                </span>
                <small class="d-block text-muted">Upvotes</small>
            </div>
        </div>

        <!-- Downvote Button -->
        <div class="text-center">
            <button wire:click="vote('downvote')"
                    class="btn btn-lg btn-outline-danger border-0 p-3 rounded-circle {{ $userVote === 'downvote' ? 'active bg-danger text-white' : '' }}"
                    title="Downvote">
                <i class="bi bi-hand-thumbs-down fs-3"></i>
            </button>
            <div class="mt-2">
                <span class="fw-bold fs-5 {{ $userVote === 'downvote' ? 'text-danger' : 'text-dark' }}">
                    {{ $downvotesCount }}
                </span>
                <small class="d-block text-muted">Downvotes</small>
            </div>
        </div>

        <!-- Vote Ratio -->
        <div class="flex-grow-1">
            <div class="progress mb-2" style="height: 10px;">
                @php
                    $total = $upvotesCount + $downvotesCount;
                    $upvotePercentage = $total > 0 ? ($upvotesCount / $total) * 100 : 0;
                    $downvotePercentage = $total > 0 ? ($downvotesCount / $total) * 100 : 0;
                @endphp
                <div class="progress-bar bg-success"
                     style="width: {{ $upvotePercentage }}%"
                     role="progressbar">
                </div>
                <div class="progress-bar bg-danger"
                     style="width: {{ $downvotePercentage }}%"
                     role="progressbar">
                </div>
            </div>
            <div class="d-flex justify-content-between small text-muted">
                <span>{{ number_format($upvotePercentage, 1) }}% Positive</span>
                <span>{{ number_format($downvotePercentage, 1) }}% Negative</span>
            </div>
        </div>
    </div>
</div>
