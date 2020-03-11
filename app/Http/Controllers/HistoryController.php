<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($history)
    {
        $history = $history;

        return view('history')->with([
            'title' => 'All History On Request'
        ]);
    }
}
