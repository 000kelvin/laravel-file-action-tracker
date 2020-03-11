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

    
}
