<?php

namespace App\Http\Livewire\Channel;

use App\Models\Channel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditChannel extends Component
{

    use WithFileUploads, AuthorizesRequests;

    public $channel;
    public $image;

    protected $rules = [
        'channel.name' => 'required|string',
        'channel.slug' => 'required|string',
        'channel.description' => 'nullable|string',
        'image' => 'nullable|image'
    ];

    public function updated($filedName)
    {
        $this->validateOnly($filedName);
    }

    public function updateChannel()
    {
        $this->validate();
        $this->channel->update([
            'name' => $this->channel->name,
            'slug' => $this->channel->slug,
            'description' => $this->channel->description
        ]);

        if ($this->image) {
            $image = $this->image->storeAs('public/images', $this->channel->uid . '.png');
            $this->channel->image = $image;
            $this->channel->save();
            session()->flash('message',  'Channel updated successfully');
        }

        if ($this->channel->wasChanged()) {
            session()->flash('message',  'Channel updated successfully');
            return redirect()->route('channel.edit', ['channel' => $this->channel]);
        }
    }

    public function mount(Channel $channel)
    {
        $this->channel = $channel;
    }

    public function render()
    {
        $this->authorize('edit', $this->channel);
        return view('livewire.channel.edit-channel');
    }
}
