<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ $channel->name }} || {{ $video->name }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200" wire:ignore>
                <video controls class="video-js vjs-styles=defaults vjs-big-play-centered vjs-responsive m-auto"
                    data-setup="{}" id="yt-video" width="360" height="360">
                    <source src="{{ $video->PlayerPath }}" type="application/x-mpegURL" />
                </video>
            </div>
        </div>
    </div>
</div>


<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h3>{{ $video->name }}</h3>
                                        <p style="color: gray">{{ $video->views }} Views . {{ $video->createdAt }}
                                        </p>
                                    </div>

                                    <div>
                                        @livewire('video.voting', ['video' => $video])
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                @livewire('channel.channel-info', ['channel' => $channel])
                            </div>
                        </div>

                        <div class="col-md-12">
                            <hr>
                            @livewire('comment.new-comment', ['video' => $video, 'reply' => 0], key($video->id))
                            @livewire('comment.all-comments', ['video' => $video])
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@push('scripts')
    <script>
        var player = videojs('yt-video');
        player.on('timeupdate', function() {
            // console.log(this.currentTime());
            if (this.currentTime() > 3) {
                // console.log('emmited');
                this.off('timeupdate');
                Livewire.emit('videoView');
            }
        });
    </script>
@endpush
