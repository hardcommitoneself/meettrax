<?php

namespace App\Listeners;

use App\Events\MeetEventUpdateCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MeetEventUpdateCreatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\MeetEventUpdateCreatedEvent  $event
     * @return void
     */
    public function handle(MeetEventUpdateCreatedEvent $event)
    {
        //
    }
}
