<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index()
    {
        $verifiers = User::where('type', 2)->get();
        return view('index')->with([
            'title' => 'Welcome',

            'verifiers' => $verifiers
        ]);
    }
}
