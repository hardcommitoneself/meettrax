<?php

namespace App\View\Components;

use App\Models\Meet;
use Illuminate\View\Component;
use Str;

class MeetAthleteCard extends Component
{

    public $meet;
    public $highlighted;
    public $athlete;
    public $entries;
    public $textColor;

    /**
     * Create a new component instance.
     * @return void
     */
    public function __construct(Meet $meet, $athlete, $highlighted = null)
    {
        $this->athlete = $athlete;
        $this->highlighted = $highlighted;

        if (Str::startsWith($athlete->first()->event->name, ["Boy's", "Men's"])) {
            $this->textColor = 'blue-500';
        } elseif (Str::startsWith($athlete->first()->event->name, ["Girl's", "Women's"])) {
            $this->textColor = 'pink-500';
        }
    }

    /**
     * Get the view / contents that represent the component.
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.meet-athlete-card');
    }
}
