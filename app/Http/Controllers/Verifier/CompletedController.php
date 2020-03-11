<?php

namespace App\Http\Controllers\Verifier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompletedController extends Controller
{
    //
    public function index() {
        return view(completed)->with([
            'title' => 'Approve Requests',

            'approveds' => $approveds
        ]);
    }
}
