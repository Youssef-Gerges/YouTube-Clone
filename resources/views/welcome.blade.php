<x-guest-layout>
    <div class="container">

        <form action="/search" method="GET">
            <div class="d-flex align-items-center my-3">
                <input type="text" name="query" id="query" class="form-control" placeholder="Search">
                <button type="submit" class="btn btn-danger ml-2"><i class="material-icons">search</i></button>
            </div>
        </form>

        <div class="row my-3">
            @if (!$channels->count())
                <p>You are not subscribed to any channel !</p>
            @endif
            @foreach ($channels as $channelVideos)
                @foreach ($channelVideos as $video)
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="{{ route('video.show', ['video' => $video, 'channel' => $video->channel]) }}"
                            class="card-link">
                            <div class="card mb-4" style="width: 333px; border:none;">
                                <img class="card-img-top" src="{{ $video->thumbnail }}" alt="Card image cap"
                                    style="height: 174px; width:333px">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $video->channel->image }}" width="40px" class="rounded circle">

                                        <h4 class="ml-3">{{ $video->name }}</h4>

                                    </div>
                                    <p class="text-gray mt-4 font-weight-bold" style="line-height: 0.2px">
                                        {{ $video->channel->name }}
                                    </p>
                                    <p class="text-gray font-weight-bold" style="line-height: 0.2px">
                                        {{ $video->views }} views •
                                        {{ $video->created_at }}</p>
                                </div>
                            </div>
                        </a>

                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
</x-guest-layout>
