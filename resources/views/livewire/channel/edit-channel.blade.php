    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $channel->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div>
                        @if (session()->has('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif

                        <form wire:submit.prevent="updateChannel">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" class="form-control" type="text"
                                    wire:model.lazy="channel.name" />
                            </div>
                            @error('channel.name')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input id="slug" class="form-control" type="text"
                                    wire:model.lazy="channel.slug" />
                            </div>
                            @error('channel.slug')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" class="form-control" rows="3" wire:model.lazy="channel.description"></textarea>
                            </div>
                            @error('channel.description')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="form-group">
                                <label for="image">Logo</label>
                                @if ($image || $channel->image)
                                    <img src="{{ $image?->temporaryUrl() ?? $channel->image }}"
                                        class="rounded  d-block" style="width: 100px">
                                @endif
                                <input id="image" class="form-control" type="file" wire:model="image" />
                            </div>
                            @error('image')
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
