<?php

namespace App\Http\Livewire\Video;

use App\Models\Channel;
use App\Models\Video;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, AuthorizesRequests;
    public Channel $channel;
    protected $paginationTheme = 'bootstrap';

    public function delete(Video $video)
    {
        Storage::deleteDirectory('public/videos/' . $video->uid);
        Storage::delete('public/videos/' . $video->path);
        $video->delete();
    }

    public function mount($channel)
    {
        $this->channel = $channel;
    }
    public function render()
    {
        return view('livewire.video.index')->with('videos', $this->channel->videos()->orderBy('created_at', 'desc')->paginate(10));
    }
}
