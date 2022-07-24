<x-guest-layout>
    <div class="container">

        <div class="row my-4">
            @foreach ($videos as $video)
                <div class="col-12 ">

                    <a href="{{ route('video.show', ['channel' => $video->channel, 'video' => $video]) }}"
                        class="card-link">
                        <div class="card mb-4 " style="border:none;">

                            <div class="card-horizontal">
                                <div>
                                    <img class="" src="{{ asset($video->thumbnail) }}" alt="Card image cap"
                                        style="height: 100%; width:333px">
                                </div>
                                <div class="card-body">
                                    <h4 class="ml-3">{{ $video->name }}</h4>
                                    <p class="text-gray font-weight-bold">{{ $video->views }} views •
                                        {{ $video->created_at }}</p>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $video->channel->image }}" width="30px"
                                            class="rounded circle mr-3">
                                        <p class="text-gray font-weight-bold">
                                            {{ $video->channel->name }}
                                        </p>

                                    </div>
                                    <p class="text-truncate">
                                        {{ $video->description }}
                                    </p>


                                </div>
                            </div>
                        </div>
                    </a>

                </div>
            @endforeach
        </div>

    </div>
</x-guest-layout>
