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
        $dissaproveds = FileActions::where('status', 2)->get();
        return view('dissaproved')->with([
            'title' => 'All Dissaproved Requests',

            'dissaproveds' => $dissaproveds
        ]);
    }
}
