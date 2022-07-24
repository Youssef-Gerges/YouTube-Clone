<div>
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex justify-content-center align-items-center">
            <img class="img-thumbnail" style="width: 100px; border-radius: 50px; display:inline"
                src="{{ $channel->image }}" alt="channel-logo">

            <span style="display: flex; flex-direction: column; justify-content: flex-start; align-items:flex-start"
                class="ml-2">
                <a href="{{ route('channel.index', ['channel' => $channel]) }}">
                    <h4 style="display:inline">{{ $channel->name }}</h4>
                </a>
                <p class="d-inline">{{ $subscribers }} Subscriber</p>
        </div>
        @if (auth()->id() != $channel->user_id)
            @if (!$subscribed)
                <button class="btn btn-danger float-right" type="button"
                    wire:click.prevent="subscribe">Subscribe</button>
            @else
                <button class="btn btn-light float-right" type="button"
                    wire:click.prevent="subscribe">Subscribed</button>
            @endif
        @endif

    </div>
</div>
</div>
