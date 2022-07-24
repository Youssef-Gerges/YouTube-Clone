<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="jumbotron jumbotron-fluid bg-primary">
        <div class="container">
            <h1 class="display-4">{{ $channel->name }}</h1>
            <p class="lead">{{ $channel->description }}</p>
        </div>
    </div>


    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <img src="{{ asset($channel->image) }}" class="rounded-circle mr-3" width="110px;">
                <div>
                    <h3>{{ $channel->name }}</h3>
                    <p>{{ $channel->subscribers->count() }} Subscribers</p>
                </div>
            </div>
            <div>
                @can('edit', $channel)
                    <a href="{{ route('channel.edit', $channel) }}" class="btn btn-primary">Edit Channel</a>
                @endcan
            </div>
        </div>




    </div>


    <div class="container">
        <div class="row my-4">
            @foreach ($videos as $video)
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
        </div>
    </div>
</x-app-layout>
