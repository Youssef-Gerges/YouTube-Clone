@auth

    <div>
        <div class="d-flex align-items-center justify-content-start">
            <img src="{{ auth()->user()->Channel->image }}" alt="logo" class="rounded-img" style="height: 50px;">

            <input type="text" wire:model="body" class="my-2 ml-2 mr-2" placeholder="add a public comment" />

            @if ($body)
                <div class="d-flex justify-content-center align-items-center">
                    <button class="btn btn-light mr-2" type="button" wire:click="resetBody">RESET</button>
                    <button class="btn btn-primary" type="button" wire:click="addComment">COMMENT</button>
                </div>
            @endif
        </div>
    </div>
@else
    <a href="{{ route('login') }}">Please login to put comment</a>
@endauth
