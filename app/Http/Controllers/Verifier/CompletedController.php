<?php

namespace App\Http\Controllers\Verifier;

use App\FileActions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompletedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $verifierId = auth()->user()->id;
        $completeds = FileActions::where([['status', '=', 0], ['steps', '>', 1], ['verifier_id', '=', $verifierId]])->orderBy('steps', 'desc')->get();
        // dd($completeds);
        return view('completed')->with([
            'title' => 'Approve Requests',

            'completeds' => $completeds
        ]);
    }

    public function approve($id)
    {
        $pendings = FileActions::find($id);

        $current_step = $pendings->steps;

        $pendings->steps = $current_step + 100000;
        $pendings->status = 1;
        $pendings->save();

        activity()->performedOn($pendings)
            ->causedBy(auth()->user()->id)
            ->withProperties(['customProperty' => 'customValue'])
            ->log('I just did some matching');


        return redirect()->back()->with('success', 'Successfully approved the request');
    }

    public function disapprove($id)
    {
        $pendings = FileActions::find($id);

        $current_step = $pendings->steps;

        $pendings->steps = $current_step + 100000;
        $pendings->status = 2;
        $pendings->save();

        activity()->performedOn($pendings)
            ->causedBy(auth()->user()->id)
            ->withProperties(['customProperty' => 'customValue'])
            ->log('I just did some matching');


        return redirect()->back()->with('success', 'Successfully dissaproved the request, the request can still be found in the dissaproved section');
    }
}
