<?php

namespace App\View\Components;

use App\Models\MeetEvent;
use Illuminate\View\Component;

class MeetEventCard extends Component
{
    public $meetEvent;
    public $highlighted;
    public $hideOthers;
    public $search;

    /**
     * Create a new component instance.
     * @return void
     */
    public function __construct(MeetEvent $meetEvent, $highlighted = null, $search = null, $hideOthers = false)
    {
        $this->meetEvent = $meetEvent;
        $this->highlighted = $highlighted;
        $this->hideOthers = $hideOthers;
        $this->search = $search;
    }

    public function render()
    {
        return view('components.meet-event-card');
    }
}
