<?php

namespace App\Http\Controllers\Admin;

use App\FileActions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DisapprovedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $verifierId = auth()->user()->id;
        if (auth()->user()->type == 2) {
            $disapproveds = FileActions::where([['status', '=',  2], ['verifier_id', '=', $verifierId]])->get();
            return view('disapproved')->with([
                'title' => 'All Disapproved Requests By You',

                'disapproveds' => $disapproveds
            ]);
        } elseif (auth()->user()->type == 1) {
            $disapproveds = FileActions::where('status', 2)->get();
            return view('disapproved')->with([
                'title' => 'All Disapproved Requests',

                'disapproveds' => $disapproveds
            ]);
        }
    }
}
