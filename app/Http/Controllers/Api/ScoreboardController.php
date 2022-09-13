<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MeetEvent;
use App\Models\MeetEventUpdate;
use Illuminate\Http\Request;

class ScoreboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $meet_id = config('app.scoreboard_meet_id');
        $results_header = $request->request->get('results_header');
        $results = $request->request->get('results');

//        ray($payload->results_header);
//        ray($payload->results);

        $meet_event = MeetEvent::join('meets', 'meets.id', '=', 'meet_events.meet_id')
            ->where([
                ['meet_events.meet_id', $meet_id],
                ['meet_events.name', $results_header['event_name']],
            ])->select('meet_events.*')->first();

        if ($meet_event instanceof MeetEvent && $meet_event->id > 0) {
            $update = MeetEventUpdate::create([
                'meet_event_id' => $meet_event->id,
                'body'          => ['results' => $results, 'results_header' => $results_header],
            ]);
        }

        exit();
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
