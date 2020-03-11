<?php

namespace App\Http\Controllers\Admin;

use App\FileActions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApprovedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $verifierId = auth()->user()->id;
        if (auth()->user()->type == 2) {
            $approveds = FileActions::where([['status', '=',  1], ['verifier_id', '=', $verifierId]])->get();
            return view('approved')->with([
                'title' => 'All Approved Requests By You',

                'approveds' => $approveds
            ]);
        } elseif (auth()->user()->type == 1) {
            $approveds = FileActions::where('status', 1)->get();
            return view('approved')->with([
                'title' => 'All Approved Requests',

                'approveds' => $approveds
            ]);
        }
    }
}
