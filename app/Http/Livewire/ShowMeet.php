<?php

namespace App\Http\Livewire;

use App\Models\Meet;
use App\Models\MeetEventUpdate;
use Illuminate\Support\Facades\Redis;
use Livewire\Component;
use Livewire\WithPagination;

class ShowMeet extends Component
{
    use WithPagination;

    public $meet;
    public $views;
    public $schools;
    public $highlighted;
    public $hideOthers = false;
    public $search;
    public $searchEvents;
    public $groupBy = 'event';
    public $eventUpdating;
    public $eventUpdateMessage;
    public $countOfUpdates = 20;

    protected $listeners = [
        'echo:MeetEventUpdates,MeetEventUpdateCreatedEvent' => 'render',
    ];

    public function mount(Meet $meet)
    {
        $this->meet = $meet;
        $this->views = Redis::get('meets.' . $meet->id . '.views');

        $this->schools = $this->meet->schools();

        if (session()->has('meet.' . $this->meet->id . '.highlighted')) {
            $this->highlighted = session('meet.' . $this->meet->id . '.highlighted');
        }

        if (session()->has('meet.' . $this->meet->id . '.hideOthers')) {
            $this->hideOthers = session('meet.' . $this->meet->id . '.hideOthers');
        }

        if (session()->has('meet.' . $this->meet->id . '.groupBy')) {
            $this->groupBy = session('meet.' . $this->meet->id . '.groupBy');
        }
    }

    public function updatedHighlighted($value)
    {
        session(['meet.' . $this->meet->id . '.highlighted' => $value]);
        if (empty($value)) {
            $this->hideOthers = false;
            session(['meet.' . $this->meet->id . '.hideOthers' => false]);
        }
    }

    public function updatedSearch()
    {
    }

    public function updatedSearchEvents()
    {
    }

    public function updatedGroupBy()
    {
        Redis::incr('meets.groupBy.' . $this->groupBy);
        session(['meet.' . $this->meet->id . '.groupBy' => $this->groupBy]);
    }

    public function toggleHideOthers()
    {
        $this->hideOthers = !$this->hideOthers;
        session(['meet.' . $this->meet->id . '.hideOthers' => $this->hideOthers]);
    }

    public function fetchData()
    {
        $events = collect([]);
        if ($this->groupBy === 'event') {
            $query = $this->meet->events()->with('sections', 'sections.entries', 'updates');
            // search for events
            if ($this->searchEvents) {
                $search_string = preg_replace('/[^A-Za-z0-9 ]/', '', $this->searchEvents);
                if ($search_string) {
                    $q = '%' . $search_string . '%';
                    $query->where('meet_events.name', 'like', $q);
                }
            }
            // hide other competitors
            if ($this->highlighted && $this->hideOthers) {
                $query->with([
                    'sections.entries' => function ($q) {
                        $q->where('meet_entries.school', $this->highlighted)->orderBy('id');
                    },
                ]);
            }
            // search for an athletes
            if ($this->search) {
                $search_string = preg_replace('/[^A-Za-z0-9 ]/', '', $this->search);
                if ($search_string) {
                    $like = '%' . $search_string . '%';
                    $query->with([
                        'sections.entries' => function ($q) use ($like) {
                            $q->where('meet_entries.name', 'like', $like);
                        },
                    ]);
                }
            }

            // hide all empty events
            foreach ($query->orderBy('id')->get() as $e) {
                if ($e->sections->count() > 0) {
                    foreach ($e->sections as $s) {
                        if ($s->entries->count() > 0) {
                            $events->push($e);
                            continue 2;
                        }
                    }
                }
            }
        }

        $athletes = collect([]);
        if ($this->groupBy === 'athlete') {
            $query = $this->meet->entries()->orderBy('name')->with('event', 'section');

            // hide other competitors
            if ($this->highlighted && $this->hideOthers) {
                $query->where('meet_entries.school', $this->highlighted);
            }

            // search for events
            if ($this->searchEvents) {
                $search_string = preg_replace('/[^A-Za-z0-9 ]/', '', $this->searchEvents);
                if ($search_string) {
                    $q = '%' . $search_string . '%';
                    $query->where('meet_events.name', 'like', $q);
                }
            }

            // search for an athletes
            if ($this->search) {
                $search_string = preg_replace('/[^A-Za-z0-9 ]/', '', $this->search);
                if ($search_string) {
                    $q = '%' . $search_string . '%';
                    $query->where('meet_entries.name', 'like', $q);
                }
            }

            $athletes = $query->get()->groupBy('name');
        }

        $updates = collect([]);
        $updates = $this->meet->updates();
        if ($this->highlighted && $this->hideOthers) {
            $str = '%\"affiliation\": \"' . $this->highlighted . '\"%';
            $updates->where('body', 'like', $str);
        }
        $updates = $updates->orderByDesc('id')->with('meetEvent')->paginate($this->countOfUpdates);
        return [$events, $athletes, $updates];
    }

    public function showEventUpdateModal($meetEventId, $highlighted)
    {
        $this->emit('showEventUpdates', [$meetEventId, $highlighted]);
        $this->dispatchBrowserEvent('event-update-modal');
    }

    public function saveUpdate()
    {
        MeetEventUpdate::create([
            'meet_event_id' => $this->eventUpdating->id,
            'body'          => $this->eventUpdateMessage,
        ]);

        $this->dispatchBrowserEvent('event-update-modal-close-modal');
    }

    public function render()
    {
        [$events, $athletes, $updates] = $this->fetchData();

        //$this->resetPage();
        return view('livewire.show-meet', compact('events', 'athletes', 'updates'));
    }
}
