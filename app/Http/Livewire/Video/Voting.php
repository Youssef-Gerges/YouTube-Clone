<?php

namespace App\Http\Livewire\Video;

use App\Models\DisLike;
use App\Models\Like;
use App\Models\User;
use App\Models\Video;
use Livewire\Component;

class Voting extends Component
{
    protected $listeners = ['loadValues' => 'loader'];
    public Video $video;
    public $likes;
    public $likeActive;
    public $disLikes;
    public $disLikeActive;


    public function loader()
    {
        $this->likes = $this->video->likes()->count();
        $this->disLikes = $this->video->disLikes()->count();
        $this->likeActive = $this->video->liked;
        $this->disLikeActive = $this->video->disLiked;
    }

    public function like()
    {
        if (!auth()->user()) {
            return redirect()->route('login');
        }

        $candidates = ['user_id' => auth()->id(), 'video_id' => $this->video->id];
        if ($this->likeActive) {
            User::find(auth()->id())->likes()->whereVideoId($this->video->id)->delete();
            $this->emit('loadValues');
            return;
        }

        if ($this->disLikeActive) {
            DisLike::where($candidates)->delete();
        }

        Like::create($candidates);
        $this->emit('loadValues');
    }

    public function disLike()
    {
        if (!auth()->user()) {
            return redirect()->route('login');
        }
        $candidates = ['user_id' => auth()->id(), 'video_id' => $this->video->id];
        if ($this->disLikeActive) {
            User::find(auth()->id())->disLikes()->whereVideoId($this->video->id)->delete();
            $this->emit('loadValues');
            return;
        }

        if ($this->likeActive) {
            Like::where($candidates)->delete();
        }

        DisLike::create($candidates);
        $this->emit('loadValues');
    }

    public function mount(Video $video)
    {
        $this->video = $video;
        $this->likes = $this->video->likes()->count();
        $this->disLikes = $this->video->disLikes()->count();
        $this->likeActive = $this->video->liked;
        $this->disLikeActive = $this->video->disLiked;
    }
    public function render()
    {
        return view('livewire.video.voting');
    }
}
