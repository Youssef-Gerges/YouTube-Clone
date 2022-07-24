<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ $channel->name }} || Edit: {{ $video->name }}
    </h2>
</x-slot>

<div class="py-12" @if ($video->processing_percentage < 100) wire:poll @endif>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">

                <div>
                    @if (session()->has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    @if ($video->thumbnail)
                        <img class="img-thumbnail" src="{{ $video->thumbnail }}" alt="thumbnail">
                        <p>Processing:
                            {{ $video->processing_percentage }}%</p>
                    @endif
                    <form wire:submit.prevent="updateVideo">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" class="form-control" type="text" wire:model.lazy="video.name" />
                        </div>
                        @error('video.name')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" class="form-control" rows="3" wire:model.lazy="video.description"></textarea>
                        </div>
                        @error('video.description')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="form-group">
                            <label for="my-select">Visibility</label>
                            <select id="my-select" class="form-control" wire:model="video.visibility">
                                <option value="unlisted">Unlisted</option>
                                <option value="private">Private</option>
                                <option value="public">Public</option>
                            </select>
                        </div>
                        @error('video.visibility')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="allow_likes"
                                    wire:model.lazy="video.allow_likes">
                                <label class="custom-control-label" for="allow_likes">Allow Likes</label>
                            </div>
                        </div>
                        @error('video.allow_likes')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="allow_comments"
                                    wire:model.lazy="video.allow_comments">
                                <label class="custom-control-label" for="allow_comments">Allow Comments</label>
                            </div>
                        </div>
                        @error('video.allow_comments')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </form>
                </div>



            </div>
        </div>
    </div>
</div>
