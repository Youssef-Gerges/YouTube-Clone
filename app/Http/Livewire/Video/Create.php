<?php

namespace App\Http\Livewire\Video;

use App\Jobs\ConvertVideo;
use App\Jobs\CreateThumbFromVideo;
use App\Models\Channel;
use App\Models\Video;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{

    use WithFileUploads;

    public Channel $channel;
    public $videoFile;

    public function mount(Channel $channel)
    {
        $this->channel = $channel;
    }


    protected $rules = [
        'videoFile' => 'required|file|mimes:mp4|max:102400',
    ];

    public function fileCompleted()
    {
        $this->validate();
        $uid = uniqid(true);
        $path = $this->videoFile->storeAs('public/videos', $uid . '.mp4');
        $video = $this->channel->videos()->create([
            'name' => 'untitled',
            'description' => 'none',
            'visibility' => 'private',
            'uid' =>  $uid,
            'path' => explode('/', $path)[2]
        ]);

        CreateThumbFromVideo::dispatch($video);
        ConvertVideo::dispatch($video);

        return redirect()->route('video.edit', ['channel' => $this->channel, 'video' => $video]);
    }
    public function render()
    {
        return view('livewire.video.create');
    }
}
