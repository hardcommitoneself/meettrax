<?php

namespace App\Http\Controllers;

use App\Models\Meet;
use Illuminate\Support\Facades\Redis;

class MeetController extends Controller
{
    //
    public function list()
    {
        Redis::incr('meets.list.views');
        return view('meets');
    }

    public function show(Meet $meet)
    {
        Redis::incr('meets.' . $meet->id . '.views');
        return view('meet', compact('meet'));
    }

    public function upload()
    {
        return view('upload');
    }
}
