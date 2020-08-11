<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tracker;
use App\Buque;

class TrackerController extends Controller
{
    //
    public function index() {
        $trackers=Tracker::all();
        return view('tracker.index',compact('trackers'));
    }

    public function create() {
        $buques=Buque::all();
        return view('tracker.create',compact('buques'));
    }

    public function store(Request $request) {
        $data=$request->all();
        Tracker::create($data);
        return redirect()->route('trackers.index');
    }

    public function edit(Tracker $tracker) {
        $buques=Buque::all();
        return view('tracker.edit',compact('tracker','buques'));
    }

    public function update(Request $request, Tracker $tracker) {
        $data=$request->all();
        $tracker->update($data);
        return redirect()->route('trackers.index');
    }

    public function destroy(Tracker $tracker) {
        $tracker->delete();
        return redirect()->route('trackers.index');
    }

    public function assignBuque() {

    }
    //ds d
}
