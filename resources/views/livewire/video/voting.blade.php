<div>
    <div class="d-flex" style="color: gray; font-size:1.2rem">
        <div class="d-flex align-items-center">
            <span>
                <i class="bi bi-emoji-smile"
                    style="cursor: pointer;font-size:1.5rem; {{ $likeActive ? 'color:green' : null }}"
                    wire:click.prevent="like"></i>
                {{ $likes }}
            </span>
            <span>
                <i class="bi bi-emoji-smile-upside-down ml-3"
                    style="cursor: pointer;font-size:1.5rem; {{ $disLikeActive ? 'color:red' : null }}"
                    wire:click.prevent="disLike"></i> {{ $disLikes }}
            </span>
        </div>
    </div>
</div>
