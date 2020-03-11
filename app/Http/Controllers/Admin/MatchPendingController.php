<?php

namespace App\Http\Controllers\Admin;

use App\FileActions;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class MatchPendingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pendings = FileActions::where('status', 0)->get();
        return view('pending')->with([
            'title' => 'Match Pending Requests',

            'pendings' => $pendings
        ]);
    }

    public function match($id)
    {
        $pendings = FileActions::find($id);

        $current_step = $pendings->steps;

        $pendings->steps = $current_step + 1;
        $pendings->save();

        activity()->performedOn($pendings)
            ->causedBy(auth()->user()->id)
            ->withProperties(['customProperty' => 'customValue'])
            ->log('I just did some matching');


        return redirect('/file/pending')->with('success', 'Successfully matched');
    }
}
