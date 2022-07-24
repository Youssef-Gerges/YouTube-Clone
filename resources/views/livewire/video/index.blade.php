<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ $channel->name }} || All Videos
    </h2>
</x-slot>

<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @foreach ($videos as $video)
                    <div class="card my-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <a href="{{ route('video.show', ['channel' => $channel, 'video' => $video]) }}">
                                        <img src="{{ $video->thumbnail }}" class="img-thumbnail" alt="">
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <h5>{{ $video->name }}</h5>
                                    <p class="text-truncate">{{ $video->description }}</p>
                                </div>
                                @can('edit', $channel)
                                    <div class="col-md-2">
                                        {{ $video->visibility }}
                                    </div>
                                @endcan
                                <div class="col-md-2">
                                    {{ $video->created_at }}
                                </div>
                                @can('edit', $channel)
                                    <div class="col-md-2">
                                        <a href="{{ route('video.edit', ['channel' => auth()->user()->channel, 'video' => $video->uid]) }}"
                                            class="btn btn-light btn-sm">Edit</a>
                                        <a class="btn btn-danger btn-sm"
                                            wire:click.prevent="delete('{{ $video->uid }}')">Delete</a>
                                    </div>
                                @endcan

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $videos->links() }}
        </div>
    </div>
</div>
