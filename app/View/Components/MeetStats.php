<?php

namespace App\View\Components;

use App\Models\Meet;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class MeetStats extends Component
{

    public $countSchools = 0;
    public $countAthletes = 0;
    public $countEntries = 0;

    /**
     * Create a new component instance.
     * @return void
     */
    public function __construct(public Meet $meet)
    {
        if (!Cache::has('meets.' . $this->meet->id . '.schools')) {
            $this->meet->cacheStats();
        }

        $this->countSchools = Cache::get('meets.' . $this->meet->id . '.schools');
        $this->countAthletes = Cache::get('meets.' . $this->meet->id . '.athletes');
        $this->countEntries = Cache::get('meets.' . $this->meet->id . '.entries');
    }

    /**
     * Get the view / contents that represent the component.
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.meet-stats');
    }
}
