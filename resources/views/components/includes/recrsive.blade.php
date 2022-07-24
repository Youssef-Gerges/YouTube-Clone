@foreach ($comments as $comment)
    <div class="media" x-data="{ open: false }">
        <img class="rounded-circle" src="{{ $comment->user->Channel->image }}" alt="logo" width="50">
        <div class="media-body ml-3">
            <h5 class="mb-0">{{ $comment->user->name }}</h5>
            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
            <br />
            {{ $comment->body }}
            @livewire('comment.new-comment', ['video' => $comment->video, 'reply' => $comment->id], key($comment->id))


            @if ($comment->replies->count() > 0)
                <a href="" @click.prevent="open = !open">{{ $comment->replies->count() }} replies</a>
                <div x-show="open">
                    <x-includes.recrsive :comments="$comment->replies" />
                </div>
            @endif
        </div>
    </div>
@endforeach
