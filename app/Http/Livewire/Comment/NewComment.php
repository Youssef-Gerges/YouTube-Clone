<?php

namespace App\Http\Livewire\Comment;

use App\Models\Video;
use Livewire\Component;

class NewComment extends Component
{
    public Video $video;
    public $body;
    public $reply;

    public function resetBody()
    {
        $this->body = "";
    }

    public function addComment()
    {
        auth()->user()->comments()->create([
            'body' => $this->body,
            'video_id' => $this->video->id,
            'reply_id' => $this->reply
        ]);

        $this->emit('commentCreated');
        $this->body = "";
    }

    public function mount(Video $video, $reply)
    {
        $this->video = $video;
        $reply == 0 ? $this->reply = null : $this->reply = $reply;
    }
    public function render()
    {
        return view('livewire.comment.new-comment');
    }
}
