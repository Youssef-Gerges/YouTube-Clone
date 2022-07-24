<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ $channel->name }} | Upload new video
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">

                <form x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false, $wire.fileCompleted()"
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <div class="form-group">
                        <label for="videoFile">Video</label>
                        <input class="form-control" type="file" wire:model="videoFile" x-show="!isUploading" />
                    </div>
                    <div class="progress" x-show="isUploading || progress == 100">
                        <div class="progress-bar bg-primary" :style="`width: ${progress}%`" role="progressbar"
                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    @error('videoFile')
                        <div class="alert
                            alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </form>

            </div>
        </div>
    </div>
</div>
