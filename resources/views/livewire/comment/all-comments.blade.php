<div>
    <h4>{{ $video->commentsCount() }} Comment</h4>

    <x-includes.recrsive :comments="$video
        ->comments()
        ->latestFirst()
        ->get()" />

</div>
