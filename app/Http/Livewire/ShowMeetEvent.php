<?php

namespace App\Http\Livewire;

use App\Models\MeetEvent;
use Livewire\Component;

class ShowMeetEvent extends Component
{
    public $meetEvent;
    public $highlighted;
    public $updates;

    protected $listeners = [
        'showEventUpdates',
        'echo:MeetEventUpdates,MeetEventUpdateCreatedEvent' => 'render',
    ];

    public function showEventUpdates($data)
    {
        $this->meetEvent = MeetEvent::findOrFail($data[0]);
        $this->highlighted = $data[1];
    }

    public function mount()
    {
    }

    public function fetchData()
    {
        $this->updates = $this->meetEvent->updates()->orderByDesc('id')->get();
    }

    public function render()
    {
        if ($this->meetEvent) {
            $this->fetchData();
        } else {
            $this->updates = collect([]);
        }
        return view('livewire.show-meet-event', [
            'updates' => $this->updates,
        ]);
    }
}
