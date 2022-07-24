<?php

namespace App\Http\Livewire\Video;

use App\Models\Channel;
use App\Models\Video;
use Livewire\Component;

class Edit extends Component
{
    public Channel $channel;
    public Video $video;

    protected $rules = [
        'video.name' =>  'string|required',
        'video.description' => 'string|nullable',
        'video.visibility' => 'required|in:private,public,unlisted',
        'video.allow_likes' => 'boolean|required',
        'video.allow_comments' => 'boolean|required'
    ];

    public function mount($channel, $video)
    {
        $this->channel = $channel;
        $this->video = $video;
    }

    public function render()
    {
        return view('livewire.video.edit');
    }

    public function updateVideo()
    {
        $this->validate();
        $this->video->update([
            'name' => $this->video->name,
            'description' => $this->video->description,
            'visibility' => $this->video->visibility,
            'allow_likes' => $this->video->allow_likes,
            'allow_comments' => $this->video->allow_comments,
        ]);

        if ($this->video->wasChanged()) {
            session()->flash('message',  'Video updated successfully');
            return redirect()->route('video.edit', ['channel' => $this->channel, 'video' => $this->video]);
        }
    }
}
