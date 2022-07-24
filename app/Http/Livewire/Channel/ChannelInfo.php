<?php

namespace App\Http\Livewire\Channel;

use App\Models\Channel;
use App\Models\User;
use Livewire\Component;

class ChannelInfo extends Component
{
    protected $listeners = ['reload' => 'reloader'];
    public Channel $channel;
    public $subscribed;
    public $subscribers;

    public function reloader()
    {
        $this->subscribed = $this->channel->subscribed;
        $this->subscribers = $this->channel->subscribers()->count();
    }

    public function subscribe()
    {

        if (!auth()->user()) {
            return redirect()->route('login');
        }

        if ($this->subscribed) {
            auth()->user()->subscribtions()->whereChannelId($this->channel->id)->delete();
            $this->emit('reload');
            return;
        }

        auth()->user()->subscribtions()->create([
            'channel_id' => $this->channel->id,
            // 'user_id' => auth()->id()
        ]);
        $this->emit('reload');
    }

    public function mount(Channel $channel)
    {
        $this->channel = $channel;
        $this->subscribed = $this->channel->subscribed;
        $this->subscribers = $this->channel->subscribers()->count();
    }
    public function render()
    {
        return view('livewire.channel.channel-info');
    }
}
