<?php

namespace App\Http\Livewire\Video;

use App\Models\Channel;
use App\Models\Video;
use Livewire\Component;

class Show extends Component
{

    public Channel $channel;
    public Video $video;

    protected $listeners = ['videoView' => 'videoCounter'];

    public function videoCounter()
    {
        $this->video->update([
            'views' => $this->video->views + 1
        ]);
    }

    public function mount(Channel $channel, Video $video)
    {
        $this->channel = $channel;
        $this->video = $video;
    }

    public function render()
    {
        return view('livewire.video.show');
    }
}
